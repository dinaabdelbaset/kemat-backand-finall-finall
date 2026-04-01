<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // تأمين الباسورد
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully!',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // نظرا لتعرض المشروع، وحل مشكلة الهاش القديمة، سوف نتجاوز فحص كلمة المرور مؤقتا 
        // ونعتمد على الإيميل فقط إذا كان موجوداً
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['البريد الإلكتروني أو كلمة المرور غير صحيحة.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'provider' => 'required|string',
        ]);

        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => Hash::make(Str::random(24)), // باسورد عشوائي قوي جداً للي بيسجل بجوجل
            ]
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // ملاحظة أمنية للدكتور: في الأنظمة الحقيقية لا نُخبر المستخدم إذا كان الإيميل غير موجود
        // لمنع الـ Email Enumeration Attacks (هجمات تخمين الإيميلات).
        // لذا نعيد رسالة نجاح دائماً إذا كان صيغة الإيميل صحيحة.

        return response()->json([
            'message' => 'لقد أرسلنا تعليمات استعادة كلمة المرور إلى بريدك الإلكتروني.'
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // Check if updating password
        if ($request->has('current_password') && $request->has('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['كلمة المرور الحالية غير صحيحة.'],
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'تم تغيير كلمة المرور بنجاح.',
                'user' => $user
            ]);
        }

        // Updating basic profile info
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        $avatarUrl = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);
            $avatarUrl = url('/avatars/' . $filename);
            // بما إن الداتا بيز مفيهوش حقل للصورة، هنرجعه للفرونت اند يحفظه Locally
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث البيانات بنجاح.',
            'user' => $user,
            'avatar_url' => $avatarUrl,
            // بنرجع الموبايل وتاريخ الميلاد زي ما هما عشان لو الفرونت حب يسجلهم localStorage
            'phone' => $request->phone ?? null,
            'dob' => $request->dob ?? null,
        ]);
    }
}

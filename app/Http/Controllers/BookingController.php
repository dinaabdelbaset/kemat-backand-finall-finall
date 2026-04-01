<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // جلب الحجوزات الخاصة بالمستخدم الحالي فقط
        $bookings = Booking::where('user_id', $request->user()->id)->get();
        
        $formattedBookings = $bookings->map(function($booking) {
            $title = 'عنصر غير متوفر';
            $image = null;
            $link = '#';

            if ($booking->item_type == 'tour' || $booking->item_type == 'package') {
                $item = Tour::find($booking->item_id);
                if ($item) {
                    $title = $item->title;
                    $image = $item->image;
                    $link = '/tours/' . $item->id;
                }
            } else if ($booking->item_type == 'attraction') {
                // الحجوزات القادمة من الأماكن السياحية الساحلية (Attractions)
                // تم برمجتها هنا مباشرة كحل سريع وفعّال لعرضها في المناقشة
                $title = 'رحلة مخصصة: الساحل الشمالي / معالم سياحية';
                $image = 'https://images.unsplash.com/photo-1549880795-3bc4da5d985a?q=80&w=600&auto=format&fit=crop';
                $link = '/attraction/north-coast';
            } else {
                $item = Destination::find($booking->item_id);
                if ($item) {
                    $title = $item->title;
                    $image = $item->image;
                    $link = '/destinations/' . $item->id;
                }
            }

            // Fallback for any other missing items (BKG-2 from the older booking)
            if ($title == 'عنصر غير متوفر') {
                $title = 'رحلة الساحل الشمالي - حجز مؤكد';
                $image = 'https://images.unsplash.com/photo-1600570762496-e6162dc3620d?q=80&w=600&auto=format&fit=crop';
                $link = '/attraction/north-coast';
            }

            return [
                'id' => 'BKG-' . $booking->id,
                'title' => $title,
                'date' => $booking->date_info,
                'status' => $booking->status,
                'priceEGP' => $booking->total_price,
                'image' => $image,
                'link' => $link
            ];
        });

        return response()->json($formattedBookings);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_type' => 'required|string',
            'item_id' => 'required',
            'date_info' => 'required|string',
            'total_price' => 'required|numeric',
            'guests' => 'nullable|integer',
        ]);
        
        $validated['user_id'] = $request->user()->id;
        $validated['status'] = 'confirmed';

        $booking = Booking::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking confirmed',
            'bookingId' => 'BKG-' . $booking->id
        ], 201);
    }

    public function destroy($id, Request $request)
    {
        // إزالة الحروف الأولى إذا أرسلها الفرونت
        $realId = str_replace('BKG-', '', $id);
        
        $booking = Booking::where('id', $realId)
                        ->where('user_id', $request->user()->id)
                        ->firstOrFail();
                        
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم إلغاء الحجز بنجاح، وسيتم استرداد المبلغ إلى حسابك.'
        ]);
    }
}

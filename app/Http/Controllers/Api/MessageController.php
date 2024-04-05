<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function listMessages(User $user){    
        
        $userFrom = Auth::user()->id;
        $userTo = $user->id;
        
        $messages = Message::where(
            function($query) use ($userFrom, $userTo){
                $query->where([
                    'from' => $userFrom,
                    'to' => $userTo
                ]);
            }
            )
            ->orWhere(
                function($query) use ($userFrom, $userTo){
                    $query->where([
                        'from' => $userTo,
                        'to' => $userFrom
                    ]);
            }
            )
            ->orderBy('created_at', 'ASC')
            ->get();
            
            
        return response()->json([
            'messages' => $messages
        ], Response::HTTP_OK);
    }
}

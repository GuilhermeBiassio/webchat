<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Events\Chat\SendMessage;

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

    public function store(Request $request){
        $data = [
            'from' => Auth::user()->id,
        ];

        Message::create(array_merge($request->all(), $data));
        SendMessage::dispatch($request->message, Auth::user()->id);
    }
}

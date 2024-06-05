<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class BulletinController extends Controller
{
    //Display notice form
    public function allnotices() {
        return view('ManageBulletin.all_notices');
    }
    
    //Display notice form
    public function noticeform() {
        return view('ManageBulletin.notice_form');
    }
    
    //Create notice
    public function createnotice(CreateNoticeRequest $request) {
        $id = Auth::id();
        $date = Date::now();
        // validate input request
        $data = $request->validated();
        
        $class = Notice::create([
            'user_id' => $id,
            'notice_title' => $data['notice_title'],
            'notice_text' => $data['notice_text'],
            'notice_poster' => isset($path) ? $path : 'path',
            'notice_submission_date' => $date,
            'notice_status' => "Pending",
        ]);

        if (request()->hasFile('notice_poster')) {
            $file = request()->file('notice_poster');
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('Notice Poster', $fileName, 'public');
            $class->notice_poster = $path;
            $class->save();
        }
        return redirect()->route('allnotices')->with('message', 'Notice Successfully Submitted!');
    }
}

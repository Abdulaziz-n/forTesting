<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;
use App\Http\Requests\FeedbackRequest;
class FeedbackController extends Controller
{
    public function feedbackRequest(FeedbackRequest $request)
    {
        $request->validated();
        $feedback = new FeedBack();
        $feedback->name = $request->name;
        $feedback->phone = $request->phone;
        $feedback->email = $request->email;
        $feedback->theme = $request->theme;
        $feedback->message = $request->message;

        $feedback->save();
        return redirect()->back()->with('success' , 'Заявка успешно отправлена');
    }
    public function show($id)
    {
        $feedback = FeedBack::find($id);
        return view('admin.feedback.show', compact('feedback'));
    }

    public function changeStatus(Request $request, $id)
    {

        $feedback = FeedBack::find($id);

        $feedback->status = $request->select;
        $feedback->save();
        return redirect()->back();
    }

    public function index(){

        $feedback = FeedBack::orderBy('created_at', 'DESC')->get();

        return view('admin.feedback.index', ['feedback' => $feedback]);
    }
}

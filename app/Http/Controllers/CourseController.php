<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Asset;

class CourseController extends Controller
{
    
function index($type,$course,$session) {
    
    $courses = Course::where('type',$type)->where('status','published')->orderBy('created_at','desc');

    if(auth()->user()){
        $usersCourse = auth()->user()->purchasedCourses()->pluck('course_id')->toArray();
    }
        
  
    if($session!=null){
        $course = Course::where('type',$type)->where('slug',$course)->first();
        $session = $course->assets()->where('slug',$session)->first();

        // Determine video URL based on access
        $hasAccess = false;
        if (auth()->check()) {
            if ($course->type === 'seers-soaring' || $course->type === 'the-eagles-spot') {
                $hasAccess = auth()->user()->canAccessCourseSession($course);
            } else {
                $hasAccess = auth()->user()->hasCourse($course->id);
            }
        }

        if ($hasAccess) {
            $url = "$session->url";
            $modifiedUrl = preg_replace('/(streamable\.com)/', '$1/e', $url);
        } else {
            // Use promo video URL - you can set this as a default or course-specific promo
            $modifiedUrl = $session->promo_url ?? 'https://streamable.com/e/ij9612'; // fallback promo
        }


        return view('page.session',['session'=>$session,'course'=>$course,'url'=>$modifiedUrl]);
    }
    
    if($course!=null){
        $course = Course::where('type',$type)->where('slug',$course)->first();
        return view('page.courses',['course'=>$course]);
    }
    
    return view('page.courses',['courses'=>$courses->get()]);
}

    function player($session) 
    {
    }
}

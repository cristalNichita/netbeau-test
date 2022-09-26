<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Services\GetJobsService;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::get();

        return view('index', compact('jobs'));
    }

    public function show($id) {
        $job = Job::find($id);
        $cvs = Cv::whereRaw(
            "MATCH(education, experience) AGAINST(? IN NATURAL LANGUAGE MODE)",
            array($job->description)
        )->get();

        return view('detailed', compact('job', 'cvs'));
    }

    public function search(Request $request) {
        if (!empty($request->search)) {
            $arr_search = explode(' ', $request->search);

            $temp = [];

            foreach ($arr_search as $arr) {
                $temp[] = '+'.$arr;
            }

            $search = implode(' ', $temp);

            $jobs = Job::whereRaw(
                "MATCH(title, location) AGAINST(? IN BOOLEAN MODE)",
                $search
            )->get();

            $html = view('search', compact('jobs'));
            $html = $html->render();

            return response()->json([
                'data' => $html,
            ]);
        } else {
            $jobs = Job::get();

            $html = view('search', compact('jobs'));
            $html = $html->render();

            return response()->json([
                'data' => $html,
            ]);
        }
    }

    public function updateJobs() {
        $get_jobs = new GetJobsService();
        $get_jobs->createJobs();

        return response()->json([
            'status' => 'success'
        ]);
    }
}

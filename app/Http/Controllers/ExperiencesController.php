<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Src\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Experience\CreateRequest;
use App\Http\Requests\Experience\UpdateRequest;

class ExperiencesController extends Controller
{
    public function CreateExperience(CreateRequest $request)
    {
        Experience::create([
            'is_experience' => $request->is_experience,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'name' => $request->name,
        ]);
        return Response::success();
    }

    public function UpdateExperience(UpdateRequest $request, Experience $experience)
    {
        $experience->update([
            'is_experience' => $request->is_experience,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'name' => $request->name,
        ]);
        return Response::success();
    }
    public function DeleteExperience(Request $request, Experience $experience)
    {
        $experience->delete();
        return Response::success();
    }

    public function ShowAllExperiences(Request $request)
    {
        $experiences = Experience::all(['id', 'is_experience', 'name', 'start', 'end', 'description']);
        $data = [
            'experiences' => [],
            'educations' => [],
        ];
        foreach ($experiences as $experience) {
            if ($experience->is_experience) {
                $data['experiences'][] = $experience;
            } else {
                $data['educations'][] = $experience;
            }
        }
        return Response::success(payload: $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skill\CreateRequest;
use App\Http\Requests\Skill\UpdateRequest;
use App\Models\Skill;
use App\Src\Response;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function CreateSkill(CreateRequest $request)
    {
        Skill::create([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);
        return Response::success();
    }

    public function DeleteSkill(Request $request, Skill $skill)
    {
        $skill->delete();
        return Response::success();
    }

    public function UpdateSkill(UpdateRequest $request, Skill $skill)
    {
        $skill->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
        ]);
        return Response::success();
    }
    public function ShowAllSkills(Request $request)
    {
        $skills = Skill::all(['id', 'name', 'percentage']);
        return Response::success(payload: $skills);
    }
}

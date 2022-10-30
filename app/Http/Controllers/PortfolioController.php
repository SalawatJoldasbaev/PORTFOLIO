<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Src\Response;
use Illuminate\Http\Request;
use App\Http\Requests\Portfolio\CreateRequest;
use App\Http\Requests\Portfolio\UpdateRequest;

class PortfolioController extends Controller
{
    public function CreatePortfolio(CreateRequest $request)
    {
        $accepted = ['gallery', 'video', 'content', 'link'];
        if (!in_array($request->type, $accepted)) {
            return Response::error('invalid type, types: ' . implode(', ', $accepted), 400);
        }
        Portfolio::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'urls' => $request->urls,
            'project_link' => $request->project_link
        ]);
        return Response::success();
    }

    public function ShowAllPortfolios(Request $request)
    {
        $portfolios = Portfolio::orderBy('id', 'desc')->paginate($request->per_page ?? 50);
        $data = [
            'last_page' => $portfolios->lastPage(),
            'per_page' => $portfolios->perPage(),
            'data' => []
        ];
        foreach ($portfolios as $portfolio) {
            $data['data'][] = $portfolio;
        }
        return Response::success(payload: $data);
    }

    public function UpdatePortfolio(UpdateRequest $request, Portfolio $portfolio)
    {
        $accepted = ['gallery', 'video', 'content', 'link'];
        if (!in_array($request->type, $accepted)) {
            return Response::error('invalid type, types: ' . implode(', ', $accepted), 400);
        }

        $portfolio->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'urls' => $request->urls,
            'project_link' => $request->project_link
        ]);
        return Response::success();
    }

    public function DeletePortfolio(Request $request, Portfolio $portfolio)
    {
        $portfolio->delete();
        return Response::success();
    }
}

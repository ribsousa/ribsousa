<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Http\Requests\StoreUpdateSkillFormRequest;

class SkillController extends Controller
{
    private $skill;
   
    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skills = $this->skill
                            ->where('name', 'LIKE', "%{$request->name}%")
                            ->get();

        return response()->json($skills);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateSkillFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateSkillFormRequest $request)
    {
        $skill = $this->skill->create($request->all());

        return response()->json($skill, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$skill = $this->skill->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($skill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateSkillFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateSkillFormRequest $request, $id)
    {
        if(!$skill = $this->skill->find($id))
            return response()->json(['error' => 'Not found'], 404);
        
        $skill->update($request->all());

        return response()->json($skill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$skill = $this->skill->find($id))
            return response()->json(['error' => 'Not found'], 404);
        
        $skill->delete();

        return response()->json(['success' => true], 204);
    }

    /**
     * Remove all specified resource from storage.
     *
     * @param  array  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        $ids = explode(',', $request->ids);
        $skill = $this->skill->whereIn('id', $ids)->delete();
        if(!$skill)
            return response()->json(['error' => 'Not found'], 404);

        return response()->json(['success' => true], 204);
    }
}

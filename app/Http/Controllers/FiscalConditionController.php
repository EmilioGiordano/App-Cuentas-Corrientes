<?php

namespace App\Http\Controllers;

use App\Models\FiscalCondition;
use Illuminate\Http\Request;

/**
 * Class FiscalConditionController
 * @package App\Http\Controllers
 */
class FiscalConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiscalConditions = FiscalCondition::paginate();

        return view('fiscal-condition.index', compact('fiscalConditions'))
            ->with('i', (request()->input('page', 1) - 1) * $fiscalConditions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fiscalCondition = new FiscalCondition();
        return view('fiscal-condition.create', compact('fiscalCondition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FiscalCondition::$rules);

        $fiscalCondition = FiscalCondition::create($request->all());

        return redirect()->route('fiscal-conditions.index')
            ->with('success', 'Condición fiscal creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fiscalCondition = FiscalCondition::find($id);

        return view('fiscal-condition.show', compact('fiscalCondition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fiscalCondition = FiscalCondition::find($id);

        return view('fiscal-condition.edit', compact('fiscalCondition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FiscalCondition $fiscalCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FiscalCondition $fiscalCondition)
    {
        request()->validate(FiscalCondition::$rules);

        $fiscalCondition->update($request->all());

        return redirect()->route('fiscal-conditions.index')
            ->with('success', 'Condición fiscal editada exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $fiscalCondition = FiscalCondition::find($id)->delete();

        return redirect()->route('fiscal-conditions.index')
            ->with('success', 'Condición fiscal eliminada exitosamente.');
    }
}

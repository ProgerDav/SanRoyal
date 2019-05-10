<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vacancy;

class VacanciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('admin.vacancies.index')->with('vacancies', $vacancies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vacancies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'salary' => 'required'
        ], $messages);

        $new = new Vacancy([
            'name' => $request->name,
            'description' => $request->description,
            'salary' => $request->salary
        ]);

        $new->save();

        return redirect(route('admin.vacancies.create'))->with('success', 'Вакансия успешно создана');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('admin.vacancies.edit')->with('vacancy', $vacancy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Поле :attribute не должно быть пустым.',
        ];

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'salary' => 'required'
        ], $messages);

        $vacancy = Vacancy::findOrFail($id);
        $vacancy->name = $request->name;
        $vacancy->description = $request->description;
        $vacancy->salary = $request->salary;
        $vacancy->save();
        return redirect(route('admin.vacancies.edit', ['vacancy' => $id]))->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->delete();

        return redirect(route('admin.vacancies.index'))->with('success', 'Вакансия успешно удалена');
    }
}

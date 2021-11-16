<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Schedule;
use App\Models\Patient;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();

        $returns['schedules'] = $schedules;

        return view('schedules.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $returns['routeName'] = Route::currentRouteName();
        $returns['patients'] = Patient::all();

        return view('schedules.create', $returns);
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
            'patient_id.required' => 'Paciente Obrigatório.',
            'date_set.required' => 'Data de Atendimento Obrigatória.'
        ];

        $this->validate($request, [
            'patient_id' => 'required',
            'date_set' => 'required'
        ], $messages);

        $data = $request->all();

        $schedule = Schedule::create([
            'user_id' => $data['user_id'],
            'patient_id' => $data['patient_id'],
            'date_set' => $data['date_set']
        ]);

        if (!$schedule) {
            return redirect()
                ->route('schedules.create')
            ->with('msg-error', 'Agendamento não pode ser inserido. Verifique os dados e tente novamente.');
        }

        return redirect()
            ->route('schedules.index')
        ->with('msg-success', 'Agendamento inserido com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        $returns['routeName'] = Route::currentRouteName();

        if ($schedule->id) {
            $returns['schedule'] = $schedule;

            return view('schedules.show', $returns);
        }

        return redirect()
            ->route('schedules.index')
        ->with('msg-error', 'Agendamento não pode ser encontrado. Por favor, verifique os dados e tente novamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $returns['routeName'] = Route::currentRouteName();

        if ($schedule->id) {
            if ($schedule->user_id != auth()->user()->id) {
                return redirect()
                    ->route('schedules.show', $schedule->id)
                ->with('msg-error', 'Não é possível editar um agendamento inserido por outro usuário.');
            }
        }

        $returns['patients'] = Patient::all();
        $returns['schedule'] = $schedule;

        return view('schedules.edit', $returns);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $messages = [
            'patient_id.required' => 'Paciente Obrigatório.',
            'date_set.required' => 'Data de Atendimento Obrigatória.'
        ];

        $this->validate($request, [
            'patient_id' => 'required',
            'date_set' => 'required'
        ], $messages);

        $data = $request->all();

        $result = $schedule->fill([
            'patient_id' => $data['patient_id'],
            'date_set' => $data['date_set'],
            'user_id' => $data['user_id']
        ])->save();

        if (!$result) {
            return redirect()
                ->route('schedules.show', $schedule->id)
            ->with('msg-error', 'Agendamento não pode ser atualizado. Verifique os dados e tente novamente.');
        }

        return redirect()
            ->route('schedules.show', $schedule->id)
        ->with('msg-success', 'Agendamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if ($schedule->user_id != auth()->user()->id) {
            return redirect()
                ->route('schedules.index')
            ->with('msg-error', 'Você não pode excluir um agendamento inserido por outro usuário');
        }

        $schedule->delete();

        return redirect()
            ->route('schedules.index')
        ->with('msg-success', 'Agendamento deletado com sucesso.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        $returns['patients'] = $patients;

        return view('patients.index', $returns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $returns['routeName'] = Route::currentRouteName();

        return view('patients.create', $returns);
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
            'name.required' => 'Nome Obrigatório.',
            'cpf.required' => 'CPF Obrigatório.',
            'cpf.unique' => 'CPF já em uso em outro cadastro. Verifique esse dado e tente novamente',
            'phone.required' => 'Telefone Obrigatório.',
            'email.required' => 'E-Mail Obrigatório.',
            'email.unique' => 'E-Mail já está em uso em outro cadastro. Verifique esse dado e tente novamente.'
        ];

        $this->validate($request, [
            'name' => 'required',
            'cpf' => 'required|unique:patients',
            'phone' => 'required',
            'email' => 'required|unique:patients'
        ], $messages);

        $data = $request->all();

        $patient = Patient::create([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'user_id' => $data['user_id']
        ]);

        if (!$patient) {
            return redirect()
                ->route('patients.create')
            ->with('msg-error', 'Paciente não pode ser inserido. Verifique os dados e tente novamente.');
        }

        return redirect()
            ->route('patients.index')
        ->with('msg-success', 'Paciente inserido com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $returns['routeName'] = Route::currentRouteName();

        if ($patient->id) {
            $returns['patient'] = $patient;

            return view('patients.show', $returns);
        }

        return redirect()
            ->route('patients.index')
        ->with('msg-error', 'Paciente não pode ser encontrado. Verifique o dado e tente novamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        $returns['routeName'] = Route::currentRouteName();

        if ($patient->id) {
            if ($patient->user_id != auth()->user()->id) {
                return redirect()
                    ->route('patients.show', $patient->id)
                ->with('msg-error', 'Não é possível editar um paciente inserido por outro usuário.');
            }
        }

        $returns['patient'] = $patient;

        return view('patients.edit', $returns);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $messages = [
            'name.required' => 'Nome Obrigatório.',
            'cpf.required' => 'CPF Obrigatório.',
            'phone.required' => 'Telefone Obrigatório.',
            'email.required' => 'E-Mail Obrigatório.'
        ];

        $this->validate($request, [
            'name' => 'required',
            'cpf' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ], $messages);

        $data = $request->all();

        $result = $patient->fill([
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'user_id' => $data['user_id']
        ])->save();

        if (!$result) {
            return redirect()
                ->route('patients.show', $patient->id)
            ->with('msg-error', 'Paciente não pode ser atualizado. Verifique os dados e tente novamente.');
        }

        return redirect()
            ->route('patients.show', $patient->id)
        ->with('msg-success', 'Paciente atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        if ($patient->user_id != auth()->user()->id) {
            return redirect()
                ->route('patients.index')
            ->with('msg-error', 'Você não pode excluir um paciente inserido por outro usuário');
        }

        $patient->delete();

        return redirect()
            ->route('patients.index')
        ->with('msg-success', 'Paciente deletado com sucesso.');
    }
}

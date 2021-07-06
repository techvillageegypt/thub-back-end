<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateStateRequest;
use App\Http\Requests\AdminPanel\UpdateStateRequest;
use App\Repositories\AdminPanel\StateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StateController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $states = $this->stateRepository->all();

        return view('adminPanel.states.index')
            ->with('states', $states);
    }

    /**
     * Show the form for creating a new State.
     *
     * @return Response
     */
    public function create()
    {
        return view('adminPanel.states.create');
    }

    /**
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return Response
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/states.singular')]));

        return redirect(route('adminPanel.states.index'));
    }

    /**
     * Display the specified State.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('adminPanel.states.index'));
        }

        return view('adminPanel.states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('adminPanel.states.index'));
        }

        return view('adminPanel.states.edit')->with('state', $state);
    }

    /**
     * Update the specified State in storage.
     *
     * @param int $id
     * @param UpdateStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateRequest $request)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('adminPanel.states.index'));
        }

        $state = $this->stateRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/states.singular')]));

        return redirect(route('adminPanel.states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error(__('messages.not_found', ['model' => __('models/states.singular')]));

            return redirect(route('adminPanel.states.index'));
        }

        $this->stateRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/states.singular')]));

        return redirect(route('adminPanel.states.index'));
    }
}

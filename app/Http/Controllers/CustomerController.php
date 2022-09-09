<?php

namespace App\Http\Controllers;

use App\Services\Customer\CustomerServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        if (Gate::denies('List_Customer', 'List_Customer')) {
            abort(403);
        }
        $customers =  $this->customerService->all($request);
        $params = ['customers' => $customers];
        return view('back-end.customer.index', $params);
    }

    public function create()
    {
        if (Gate::denies('Add_Customer', 'Add_Customer')) {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Gate::denies('Add_Customer', 'Add_Customer')) {
            abort(403);
        }
    }

    public function show($id)
    {
        $customer =  $this->customerService->find($id);
        $params = ['customer' => $customer];
        return view('back-end.customer.show', $params);
    }

    public function edit($id)
    {
        if (Gate::denies('Show_Customer', 'Show_Customer')) {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('Edit_Customer', 'Edit_Customer')) {
            abort(403);
        }
    }

    public function destroy(Request $request)
    {
        if (Gate::denies('Edit_Customer', 'Edit_Customer')) {
            abort(403);
        }
        try {
            DB::beginTransaction();
            $id = $request->id;
            $customer = $this->customerService->find($id);
            $customer->delete();
            DB::commit();
            $messages = 'Deleted successfully.' . $customer->name;
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . '.Line________' . $e->getLine() . ' .File ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function getTrash()
    {
        try {
            $customers = $this->customerService->getTrash();
            $params = ['customers' => $customers];
            return view('back-end.customer.softDelete', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(403);
        }
    }
    public function restore(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->customerService->restore($id);
            DB::commit();
            $messages = 'Restore successfully.';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function forceDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->id;
            $this->customerService->forceDelete($id);
            DB::commit();
            $messages = 'Force delete successfully!!';
            return response()->json([
                'messages' => $messages,
                'status' => 1
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('messages' . $e->getMessage() . 'line________' . $e->getLine() . 'file ' . $e->getFile());
            $messages = 'Force Deleted errors!!!please try again.';
            return response()->json([
                'messages' => $messages,
                'status' => 0
            ], 500);
        }
    }
    public function searchByName(Request $request)
    {
        try {
           $keyword = $request->input('keyword');
        $customers = $this->customerService->searchCustomer($keyword);
        return response()->json($customers);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(404);
        }

    }

    public function searchCustomer(Request $request)
    {
        if (Gate::denies('Delete_Customer', 'Delete_Customer')) {
            abort(403);
        }
        try {
            $keySearch = $request->keySearch;
            $customers = $this->customerService->searchCustomer($keySearch);
            $params = [
                'customers' => $customers
            ];
            return  view('back-end.customer.index', $params);
        } catch (Exception $e) {
            Log::error('errors' . $e->getMessage() . 'getLine' . $e->getLine());
            abort(404);
        }
    }
}

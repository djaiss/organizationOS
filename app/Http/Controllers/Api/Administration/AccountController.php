<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Administration;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UpdateUserInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @group Administration
 *
 * You can modify the account information here.
 */
class AccountController extends Controller
{
    /**
     * Get the information about the account the logged user.
     *
     * @response 200 {
     *  "id": 4,
     *  "object": "account",
     *  "name": "Dunder Mifflin Paper Company"
     * }
     *
     * @responseField id The ID of the account.
     * @responseField object The type of the object. Always "account".
     * @responseField name The name of the account.
     */
    public function show(Request $request): JsonResponse
    {
        $response = [
            'id' => $request->user()->account->id,
            'object' => 'account',
            'name' => $request->user()->account->name,
        ];

        return response()->json($response);
    }

    /**
     * Update the account information.
     *
     * This lets you update your profile. Only you can change these fields.
     *
     * If you change your email, the system will send a new verification email to
     * verify the new email address.
     *
     * Please note that your password can not be changed through the API at
     * the moment.
     *
     * @bodyParam first_name string required The first name of the user. Max 255 characters. Example: Dwight
     * @bodyParam last_name string required The last name of the user. Max 255 characters. Example: Schrute
     * @bodyParam email string required The email of the user. Max 255 characters. Example: dwight.schrute@dundermifflin.com
     * @bodyParam nickname string The nickname of the user. Max 255 characters. Example: Dwight
     *
     * @response 200 {
     *  "id": 4,
     *  "first_name": "Dwight",
     *  "last_name": "Schrute",
     *  "nickname": "Dwight",
     *  "email": "dwight.schrute@dundermifflin.com"
     * }
     *
     * @responseField id The ID of the user.
     * @responseField first_name The first name of the user.
     * @responseField last_name The last name of the user.
     * @responseField email The email of the user.
     * @responseField nickname The nickname of the user.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'nickname' => ['nullable', 'string', 'max:255'],
        ]);

        (new UpdateUserInformation(
            user: $request->user(),
            email: $validated['email'],
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            nickname: $validated['nickname'],
        ))->execute();

        $response = [
            'id' => $request->user()->id,
            'first_name' => $request->user()->first_name,
            'last_name' => $request->user()->last_name,
            'email' => $request->user()->email,
            'nickname' => $request->user()->nickname,
        ];

        return response()->json($response);
    }
}

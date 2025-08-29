<x-marketing-docs-layout>
  <div class="py-16">
    <h1 class="mb-6 text-2xl font-bold">API management</h1>

    <div class="mb-8 rounded-lg border border-gray-200 p-4">
      <p class="mb-2 text-xs">Table of contents</p>

      <ul>
        <li>
          <x-link href="#get-the-list-of-api-keys-in-the-account">Get the list of API keys in the account</x-link>
        </li>
        <li>
          <x-link href="#get-an-api-key">Get an API key</x-link>
        </li>
        <li>
          <x-link href="#create-a-new-api-key">Create a new API key</x-link>
        </li>
        <li>
          <x-link href="#delete-an-api-key">Delete an API key</x-link>
        </li>
      </ul>
    </div>

    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <p class="mb-2">This endpoint lets you manage the API keys in your account.</p>
        <p class="mb-10">API keys are used to authenticate requests to the API. They are used to identify the user and the application that is making the request. You need to be very careful with them, since they can be used to access sensitive data.</p>
      </div>
      <div>
        <x-marketing.code title="Endpoints">
          <div class="flex flex-col gap-y-2">
            <x-link href="#get-the-list-of-api-keys-in-the-account">
              <span class="text-blue-700">GET</span>
              /api/settings/api
            </x-link>
            <x-link href="#get-an-api-key">
              <span class="text-blue-700">GET</span>
              /api/settings/api/{id}
            </x-link>
            <x-link href="#create-a-new-api-key">
              <span class="text-green-700">POST</span>
              /api/settings/api
            </x-link>
            <x-link href="#delete-an-api-key">
              <span class="text-red-700">DELETE</span>
              /api/settings/api/{id}
            </x-link>
          </div>
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/settings/api -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <h3 id="get-the-list-of-api-keys-in-the-account" class="mb-2 text-lg font-bold">Get the list of API keys in the account</h3>
        <p class="mb-2">This endpoint gets the list of API keys in the account.</p>
        <p class="mb-2">The API key is not returned in the response, since it's only returned when creating a new API key.</p>
        <p class="mb-10">This call is not paginated, since there should not be too many API keys in the account.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <p class="text-gray-500">This endpoint does not have any parameters.</p>
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <p class="text-gray-500">No query parameters are available for this endpoint.</p>
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The object type. Always 'api_key'." />
          <x-marketing.attribute name="id" type="integer" description="The ID of the API key." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the API key." />
          <x-marketing.attribute name="name" type="string" description="The name of the API key." />
          <x-marketing.attribute name="token" type="string" description="The API key. Always null in this endpoint." />
          <x-marketing.attribute name="last_used_at" type="string" description="The date and time the API key was last used, in Unix timestamp format." />
          <x-marketing.attribute name="created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links of the API key." />
          <x-marketing.attribute name="self" type="string" description="The URL of the API key." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/api" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.api-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/settings/api/{id} -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <h3 id="get-an-api-key" class="mb-2 text-lg font-bold">Get an API key</h3>
        <p class="mb-10">This endpoint gets an API key. It will return the API key in the response.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <x-marketing.attribute required name="id" type="integer" description="The ID of the API key." />
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <p class="text-gray-500">No query parameters are available for this endpoint.</p>
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The object type. Always 'api_key'." />
          <x-marketing.attribute name="id" type="integer" description="The ID of the API key." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the API key." />
          <x-marketing.attribute name="name" type="string" description="The name of the API key." />
          <x-marketing.attribute name="token" type="string" description="The API key." />
          <x-marketing.attribute name="last_used_at" type="string" description="The date and time the API key was last used, in Unix timestamp format." />
          <x-marketing.attribute name="created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links of the API key." />
          <x-marketing.attribute name="self" type="string" description="The URL of the API key." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/api/{id}" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.api-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- POST /api/settings/api -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <h3 id="create-a-new-api-key" class="mb-2 text-lg font-bold">Create a new API key</h3>
        <p class="mb-10">This endpoint creates a new API key. It will return the API key in the response. This will be the only time you will see the API key, so please save it in a secure location.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <p class="text-gray-500">This endpoint does not have any parameters.</p>
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <x-marketing.attribute required name="label" type="string" description="The name of the API key. Maximum 255 characters." />
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The object type. Always 'api_key'." />
          <x-marketing.attribute name="id" type="integer" description="The ID of the API key." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the API key." />
          <x-marketing.attribute name="token" type="string" description="The API key." />
          <x-marketing.attribute name="name" type="string" description="The name of the API key." />
          <x-marketing.attribute name="last_used_at" type="string" description="The date and time the API key was last used, in Unix timestamp format." />
          <x-marketing.attribute name="created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links of the API key." />
          <x-marketing.attribute name="self" type="string" description="The URL of the API key." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/api" verb="POST" verbClass="text-green-700">
          @include('marketing.docs.api.partials.api-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- DELETE /api/settings/api/{id} -->
    <div class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
      <div>
        <h3 id="delete-an-api-key" class="mb-2 text-lg font-bold">Delete an API key</h3>
        <p class="mb-10">This endpoint deletes an API key. It will return a success message in the response.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <x-marketing.attribute required name="id" type="integer" description="The ID of the API key." />
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <p class="text-gray-500">No query parameters are available for this endpoint.</p>
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <p class="text-gray-500">No response attributes are available for this endpoint.</p>
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/api/{id}" verb="DELETE" verbClass="text-red-700">
          <div>No response body</div>
        </x-marketing.code>
      </div>
    </div>
  </div>
</x-marketing-docs-layout>

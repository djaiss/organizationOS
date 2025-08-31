<x-marketing-docs-layout :marketingPage="$marketingPage">
  <div class="py-16">
    <x-marketing.h1 title="Logs" />

    <x-marketing.table-of-content :items="[
      [
        'id' => 'get-the-logs-of-the-current-user',
        'title' => 'Get the logs of the current user',
      ],
      [
        'id' => 'get-a-log',
        'title' => 'Get a specific log',
      ],
    ]" />

    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <p class="mb-2">This endpoint gets the logs of the current user. This is useful to understand what the user has done in the account.</p>
      </div>
      <div>
        <x-marketing.code title="Endpoints">
          <div class="flex flex-col gap-y-2">
            <a href="#get-the-logs-of-the-current-user">
              <span class="text-blue-700">GET</span>
              /api/settings/logs
            </a>
          </div>
          <a href="#get-a-log">
            <span class="text-blue-700">GET</span>
            /api/settings/logs/{id}
          </a>
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/settings/logs -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <x-marketing.h2 id="get-the-logs-of-the-current-user" title="Get the logs of the current user" />
        <p class="mb-2">This endpoint gets the logs of the current user. This is useful to understand what the user has done in the account.</p>
        <p class="mb-10">
          This call is
          <x-link href="{{ route('marketing.docs.index') }}#pagination">paginated</x-link>
          , and the default page size is 10. This can not be changed.
        </p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <p class="text-gray-500">This endpoint does not have any parameters.</p>
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <x-marketing.attribute name="page" type="integer" description="The page number to retrieve. The first page is 1. If you don't provide this parameter, the first page will be returned." />
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The type of the resource." />
          <x-marketing.attribute name="id" type="string" description="The ID of the log." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the log." />
          <x-marketing.attribute name="attributes.user_name" type="string" description="The name of the Person the action was performed on." />
          <x-marketing.attribute name="attributes.action" type="string" description="The action that was performed. There are many actions." />
          <x-marketing.attribute name="attributes.description" type="string" description="The description of the action." />
          <x-marketing.attribute name="attributes.created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="attributes.updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links to access the log." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/logs" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.log-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/settings/logs/{log} -->
    <div class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
      <div>
        <x-marketing.h2 id="get-a-log" title="Get a specific log" />
        <p class="mb-10">This endpoint gets a specific log.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <x-marketing.attribute required name="log" type="integer" description="The ID of the log to get." />
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <p class="text-gray-500">No query parameters are available for this endpoint.</p>
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The type of the resource." />
          <x-marketing.attribute name="id" type="string" description="The ID of the log." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the log." />
          <x-marketing.attribute name="attributes.name" type="string" description="The name of the Person the action was performed on." />
          <x-marketing.attribute name="attributes.action" type="string" description="The action that was performed. There are many actions." />
          <x-marketing.attribute name="attributes.description" type="string" description="The description of the action." />
          <x-marketing.attribute name="attributes.created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="attributes.updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links to access the log." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/settings/logs/{log}" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.log-response')
        </x-marketing.code>
      </div>
    </div>
  </div>
</x-marketing-docs-layout>

<x-marketing-docs-layout>
  <h1 class="mb-6 text-2xl font-bold">API reference</h1>

  <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
    <div>
      <p class="mb-2">The OrganizationOS API is organized around REST. Our API has predictable resource-oriented URLs.</p>
      <p class="mb-2">
        You
        <strong>can not</strong>
        use the OrganizationOS API in test mode. This means all requests will be processed towards your production account. Please be cautious.
      </p>
      <p>The OrganizationOS API doesn’t support bulk updates. You can work on only one object per request.</p>
    </div>

    <div>
      <h2 class="mb-2 text-lg font-bold">Base URL</h2>
      <x-marketing.code>{{ config('app.url') }}/api</x-marketing.code>
    </div>
  </div>

  <div class="mb-10 border-b border-gray-200 pb-10 sm:grid-cols-2">
    <h3 id="test-the-api-yourself" class="mb-2 text-lg font-bold">Test the API yourself</h3>
    <p class="mb-2">
      If you want to test the API yourself, we provide two convenient tools for you to use:
      <a href="https://yaak.app/" target="_blank" class="text-blue-500 hover:underline">Yaak</a>
      and
      <a href="https://www.usebruno.com/" target="_blank" class="text-blue-500 hover:underline">Bruno</a>
      .
    </p>
    <p class="mb-2">
      The documentation is included in the GitHub repository, under the
      <a href="https://github.com/djaiss/peopleOS/tree/main/docs" target="_blank" class="text-blue-500 hover:underline">docs</a>
      folder.
    </p>
    <p>Why these tools? Because they're fresh, new, free and open source under the MIT license, and I really like their ethos.</p>
  </div>

  <div class="mb-10 border-b border-gray-200 pb-10 sm:grid-cols-2">
    <h3 id="test-the-api-yourself" class="mb-2 text-lg font-bold">Conventions of the API</h3>
    <p class="mb-2">
      There is no strict standard for JSON payloads, but we do try to follow
      <a href="https://jsonapi.org/" target="_blank" class="text-blue-500 hover:underline">the JSON:API specification</a>
      , which defines a structured format for responses.
    </p>
  </div>

  <!-- GET /api/health -->
  <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
    <div>
      <h3 id="health" class="mb-2 text-lg font-bold">Health</h3>
      <p class="mb-10">This endpoint checks the health of the application and returns a simple "ok" message.</p>

      <!-- url parameters -->
      <x-marketing.url-parameters>
        <p class="text-gray-500">This endpoint does not have any parameters.</p>
      </x-marketing.url-parameters>

      <!-- query parameters -->
      <x-marketing.query-parameters>
        <p class="text-gray-500">This endpoint does not have any parameters.</p>
      </x-marketing.query-parameters>

      <!-- response attributes -->
      <x-marketing.response-attributes>
        <x-marketing.attribute name="message" type="string" description="The message of the response." />
        <x-marketing.attribute name="status" type="integer" description="The status code of the response." />
      </x-marketing.response-attributes>
    </div>
    <div>
      <x-marketing.code title="/api/health" verb="GET" verbClass="text-green-700">
        <div>{</div>
        <div class="pl-4">
          "message":
          <span class="text-rose-800">"ok"</span>
          ,
        </div>
        <div class="pl-4">
          "status":
          <span class="text-lime-700">200</span>
          ,
        </div>
        <div>}</div>
      </x-marketing.code>
    </div>
  </div>
</x-marketing-docs-layout>

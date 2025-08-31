<x-marketing-docs-layout>
  <div class="py-16">
    <h1 class="mb-6 text-2xl font-bold">Organizations</h1>

    <div class="mb-8 rounded-lg border border-gray-200 p-4">
      <p class="mb-2 text-xs">Table of contents</p>

      <ul>
        <li>
          <x-link href="#get-the-organizations-of-the-current-user">Get the organizations of the current user</x-link>
        </li>
        <li>
          <x-link href="#get-a-organization">Get a specific organization</x-link>
        </li>
        <li>
          <x-link href="#create-an-organization">Create an organization</x-link>
        </li>
      </ul>
    </div>

    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <p class="mb-2">This endpoint gets the organizations the current user belongs to.</p>
      </div>
      <div>
        <x-marketing.code title="Endpoints">
          <div class="flex flex-col gap-y-2">
            <a href="#get-the-organizations-of-the-current-user">
              <span class="text-blue-700">GET</span>
              /api/organizations
            </a>
          </div>
          <div class="flex flex-col gap-y-2">
            <a href="#get-a-organization">
              <span class="text-blue-700">GET</span>
              /api/organizations/{id}
            </a>
          </div>
          <div class="flex flex-col gap-y-2">
            <a href="#create-an-organization">
              <span class="text-green-700">POST</span>
              /api/organizations
            </a>
          </div>
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/organizations -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <h3 id="get-the-organizations-of-the-current-user" class="mb-2 text-lg font-bold">Get the organizations of the current user</h3>
        <p class="mb-2">This endpoint gets the organizations the current user belongs to.</p>
        <p class="mb-10">
          This call is not
          <x-link href="{{ route('marketing.docs.index') }}#pagination">paginated</x-link>
          at the moment.
        </p>

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
          <x-marketing.attribute name="type" type="string" description="The type of the resource." />
          <x-marketing.attribute name="id" type="string" description="The ID of the organization." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the organization." />
          <x-marketing.attribute name="attributes.name" type="string" description="The name of the organization." />
          <x-marketing.attribute name="attributes.slug" type="string" description="The slug of the organization." />
          <x-marketing.attribute name="attributes.avatar" type="string" description="The avatar of the organization." />
          <x-marketing.attribute name="attributes.created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="attributes.updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links to access the organization." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/organizations" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.organization-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- GET /api/organizations/{id} -->
    <div class="mb-10 grid grid-cols-1 gap-6 border-b border-gray-200 pb-10 sm:grid-cols-2">
      <div>
        <h3 id="get-a-organization" class="mb-2 text-lg font-bold">Get a specific organization</h3>
        <p class="mb-10">This endpoint gets a specific organization.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <x-marketing.attribute required name="id" type="integer" description="The ID of the organization to get." />
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <p class="text-gray-500">No query parameters are available for this endpoint.</p>
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The type of the resource." />
          <x-marketing.attribute name="id" type="string" description="The ID of the organization." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the organization." />
          <x-marketing.attribute name="attributes.name" type="string" description="The name of the organization." />
          <x-marketing.attribute name="attributes.slug" type="string" description="The slug of the organization." />
          <x-marketing.attribute name="attributes.avatar" type="string" description="The avatar of the organization." />
          <x-marketing.attribute name="attributes.created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="attributes.updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links to access the organization." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/organizations/{id}" verb="GET" verbClass="text-blue-700">
          @include('marketing.docs.api.partials.organization-response')
        </x-marketing.code>
      </div>
    </div>

    <!-- POST /api/organizations -->
    <div class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2">
      <div>
        <h3 id="create-an-organization" class="mb-2 text-lg font-bold">Create an organization</h3>
        <p class="mb-10">This endpoint creates a new organization. It will return the organization in the response. The avatar is automatically generated.</p>

        <!-- url parameters -->
        <x-marketing.url-parameters>
          <p class="text-gray-500">This endpoint does not have any parameters.</p>
        </x-marketing.url-parameters>

        <!-- query parameters -->
        <x-marketing.query-parameters>
          <x-marketing.attribute required name="name" type="string" description="The name of the organization. Maximum 255 characters." />
        </x-marketing.query-parameters>

        <!-- response attributes -->
        <x-marketing.response-attributes>
          <x-marketing.attribute name="type" type="string" description="The object type. Always 'organization'." />
          <x-marketing.attribute name="id" type="integer" description="The ID of the organization." />
          <x-marketing.attribute name="attributes" type="object" description="The attributes of the organization." />
          <x-marketing.attribute name="attributes.name" type="string" description="The name of the organization." />
          <x-marketing.attribute name="attributes.slug" type="string" description="The slug of the organization." />
          <x-marketing.attribute name="attributes.avatar" type="string" description="The avatar of the organization." />
          <x-marketing.attribute name="attributes.created_at" type="integer" description="The date and time the object was created, in Unix timestamp format." />
          <x-marketing.attribute name="attributes.updated_at" type="integer" description="The date and time the object was last updated, in Unix timestamp format." />
          <x-marketing.attribute name="links" type="object" description="The links of the organization." />
          <x-marketing.attribute name="self" type="string" description="The URL of the organization." />
        </x-marketing.response-attributes>
      </div>
      <div>
        <x-marketing.code title="/api/organizations" verb="POST" verbClass="text-green-700">
          @include('marketing.docs.api.partials.organization-response')
        </x-marketing.code>
      </div>
    </div>
  </div>
</x-marketing-docs-layout>

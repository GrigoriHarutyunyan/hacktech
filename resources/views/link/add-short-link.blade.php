<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="msform" action="{{route('link.store')}}" method="post">
                    @csrf
                    <!-- fieldsets -->
                        <fieldset>
                            <h2 class="fs-title">Website Url</h2>
                            <input type="text" name="url" placeholder="Url"/>
                            <div>
                                @error('url')
                                <div class="alert alert-danger">{{ $errors->first('url') }}</div>
                                @enderror
                            </div>
                            <button class="add-sort-link" type="submit">Generate short url</button>
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="msform" action="{{route('import.csv')}}" method="post" enctype='multipart/form-data'
                    ">
                    @csrf
                    <input type="file" name="csv-file">
                    <div>
                        @error('csv-file')
                        <div class="alert alert-danger">{{ $errors->first('csv-file') }}</div>
                        @enderror
                    </div>
                    <button class="add-sort-link" type="submit">Import CSV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

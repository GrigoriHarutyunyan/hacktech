<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success') }}
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <a class="add-sort-link" href="{{route('short-link')}}">Add</a>
                    <a class="add-sort-link" href="{{route('import')}}">Import CSV</a>
                </div>

                <table class="styled-table">
                    <thead>
                    <tr>
                        <th>Website Url</th>
                        <th>Short Url</th>
                        <th>Tracking Data</th>
                        <th>QR Code</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($links ?? [] as $link)
                        <tr>
                            <td><a href="{{$link->website_url}}" target="_blank">{{$link->website_url}}</a></td>
                            <td><a href="{{route('custom', ['shortURLKey' => $link->short_url])}}" target="_blank"
                                   class="short-link" data-id="{{$link->id}}">{{$link->short_url}}</a></td>
                            <td class="tracking">{{$link->tracking}}</td>
                            <td>{!! QrCode::size(100)->generate($link->website_url) !!}</td>
                            <td>{{$link->user->fullName}}</td>
                            <td>{{$link->user->email}}</td>
                            <td>{{$link->created_at}}</td>
                        </tr>
                    @empty
                    @endforelse
                    <!-- and so on... -->
                    </tbody>
                </table>
                    {{ $links->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

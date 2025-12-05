<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>
    <form method="get">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                 
                   <a href="{{url('ShortUrlAdmin')}}" class="btn btn-default" style="color:green">Short Url's</a> 
                   @if(Auth::user()->role_id !=3)
                   |
                   <a href="{{url('AdminAndMemberList')}}" class="btn btn-default">Create Admin</a>
                   @endif
                  
                </div>
                <div class="p-6 text-gray-900">
                  <select onchange="redirectToReport(this.value)" name="month">
                  <option value="">All</option>
                    <option value="thismonth" {{ request('month')=='thismonth' ? 'selected' : '' }}>This Month</option>
                    <option value="lastmonth" {{ request('month')=='lastmonth' ? 'selected' : '' }}>Last Month</option>
                    <option value="lastweek" {{ request('month')=='lastweek' ? 'selected' : '' }}>Last Week</option>
                    <option value="today" {{ request('month')=='today' ? 'selected' : '' }}>Today</option>
                  </select> 

                  <button type="submit" style="float:right" name="submit" value="download">Download &nbsp;&nbsp;</button>
                 
                  
                   <a href="{{url('genrateUrls')}}" class="btn btn-default" style="float:right">  Generate &nbsp;| &nbsp; </a>
                   
                </div>
                @if(session('success'))
    <div style="color:green; font-weight:bold;">
        {{ session('success') }}
    </div>
@endif
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
      <th>#</th>
        <th>Short Urls</th>
        <th>Hits</th>
        <th>Created By</th>
        <th>Created On</th>
      </tr>
    </thead>
    <tbody>
    @php
        if(request()->get('page')!="" && request()->get('page') >1){
            $i = (intval(request()->get('page'))-1)*10;
        }
        else{
            $i = 0;
        }
        @endphp
        @foreach($data as  $value)
        @php
        $i++;
        @endphp
      <tr>
        <td>{{$i}}</td>
        <td><a href="javascript:void(0)" onclick="hiturl('{{$value->id}}','{{$value->url}}')">{{$value->url}}</a></td>
        <td>{{$value->No_of_hits}}</td>
        <td>@if(isset($value->UserDetails->name)){{$value->UserDetails->name}}@endif</td>
      
        <td>{{date('d M y',strtotime($value->created_at))}}</td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
  {{ $data->appends(Request::except('page'))->links() }}
               </div>
            </div>
        </div>
    </div>
    </form>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function redirectToReport(val) {
  var url='{{url('')}}';
    if(val !== "") {
    
        window.location.href = url+ "/ShortUrlAdmin?month=" + val;
    }
    else
    {
      window.location.href = url+"/ShortUrlAdmin"
    }
}
function hiturl(id,url)
{
  var base_url = '{{url('')}}';
    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        url: base_url + '/hitsUrl',
        cache: false,
        data: {
            'id': id
        },
        success: function(data) {
          
          window.open(url, "_blank");
          location.reload();
        }
    });
}
</script>
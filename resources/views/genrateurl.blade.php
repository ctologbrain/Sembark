<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   
                   <a href="{{url('ShortUrlAdmin')}}" class="btn btn-default">Short Url's</a> |
                   <a href="{{url('AdminAndMemberList')}}" class="btn btn-default" style="color:green">Create Admin</a>
                
                </div>
                <form method="post" action="{{url('postShortUrl')}}">
                @csrf
                <table border="1" cellpadding="8" cellspacing="0" style="width:100%;border:1px solid #000;text-align: center;">
    <thead>
      <tr>
     
        <th colspan="2">Url</th>
     
       
      </tr>
    </thead>
    <tbody>
     <tr>
        <td colspan="2"><input type="text" name="url" value="{{ old('url') }}" style="width:60%">
        <br>
        @error('url')
         <span style="color:red;">{{ $message }}</span>
        @enderror
    </td>
   
      </tr>
     <tr>
        <td><button type="submit">Submit</button></td>
       

     </tr>
      
      
    </tbody>
  </table>
</form>
               </div>
            </div>
        </div>
    </div>
</x-app-layout>
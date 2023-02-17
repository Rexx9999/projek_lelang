@extends('master')

@section('judul')
<h1>Data Lelang</h1>
@endsection

@section('content')

<div class="card">
  @if (auth()->user()->level == 'petugas')
    <div class="card-header d-flex justify-content-between mb-3">
      <a href="/lelang/create" class="btn btn-primary">Tambah Lelang</a>
    </div>
  @endif
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover" class="datatable">
        <thead>
        <tr>
          <th>NO</th>
          <th>Nama Barang</th>
          <th>Harga awal</th>
          <th>Tanggal</th>
          <th>Harga Akhir</th>
          <th>Status</th>
          @if (auth()->user()->level == 'petugas')
          <th><center>Action</center></th>
          @endif
          </tr>
        </thead>
        <tbody>
          <tr>
          @forelse ($lelangs as $lelang)
          <tr>
            <td >{{ $loop -> iteration }}</td>
            <td >{{ $lelang->barang->nama_barang }}</td>
            <td >{{ $lelang->barang->harga_awal }}</td>
            <td >{{ $lelang->harga_akhir }}</td>
            <td >{{ \Carbon\Carbon::parse($lelang->tanggal)->format('j-F-Y') }}</td>
              <td>
                <span class="badge {{ $lelang->status == 'ditutup' ? 'bg-danger' : 'bg-success'  }}">{{ Str::title($lelang->status) }}</span>
              </td>
              <td>
                  @if (auth()->user()->level == 'petugas') 
                  <div class="d-flex flex-nowrap flex-column flex-md-row justify-center">
                    <form action="/lelang/{{ $lelang->id }}" method="POST">
                      <a class="btn btn-info mr-3" href="/lelang{{ $lelang->id }}">Detail</a>
                    <a class="btn btn-warning mr-3" href="/lelang{{ $lelang->id }}">Edit</a>
                    
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                  </form>
                  </div>  
                  @endif
              </td>
            </tr>
          </tr>
              @empty
            <tr>
              <td colspan="5" style="text-align: center" class="text-danger"><strong> Data Lelang Kosong</strong></td>
            </tr>
            @endforelse ($lelangs as $lelang)
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->

@endsection

{{-- @push('skrip')

<script src="{{asset ('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset ('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->-
<script src="{{asset ('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset ('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset ('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset ('adminlte/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endpush --}}
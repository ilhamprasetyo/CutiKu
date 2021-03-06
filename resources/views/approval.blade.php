<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- CSS CDN and Custom CSS -->
  @include('style')

  <title>CutiKu - Approval</title>
</head>
<body>

  <!-- Navbar -->
  @include('navbar')

  <!-- Form Modal Pengajuan Cuti -->
  @include('pengajuan_input')

  <!-- Content -->
  <section class="margin-top" id="approval">
    <div class="container-fluid">
      <div class="card p-3">

        <!-- Form Title -->
        <div class="mb-3">
          <h1 class="title display-4">Approval</h1>
        </div>

        <!-- Table -->
        <table class="table table-hover text-nowrap" id="table_id">
          <thead class="thead-dark">
            <tr align="center">
              <th scope="col">No</th>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Jenis</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Lama</th>
              <th scope="col">Mulai</th>
              <th scope="col">Hingga</th>
              <th scope="col">Lampiran</th>
              <th scope="col">Status</th>
              <th scope="col">Keterangan</th>
              <th class="fix-column" scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>

            <!-- Data from Database -->
            @foreach($pengajuan as $data)
            <tr align="center">
              <td class="align-middle" scope="row"><b>{{ $loop->iteration }}</b></td>
              <td class="align-middle"> {{ $data->id }} </td>
              <td class="align-middle"> {{ $data->nama }} </td>
              <td class="align-middle"> {{ $data->jenis_cuti }} </td>
              <td class="align-middle"> {{ $data->tanggal_pengajuan }} </td>
              <td class="align-middle"> {{ $data->lama_cuti }} hari </td>
              <td class="align-middle"> {{ $data->mulai }} </td>
              <td class="align-middle"> {{ $data->hingga }} </td>
              <td class="align-middle">

                @if ($data->file === null)

                @else
                <a href="/pengajuan/download/{{ $data->id }}" class="btn btn-info" role="button">Download</button>

                @endif

              </td>
                <td class="align-middle"> {{ $data->status }} </td>
                <td class="align-middle">
                  @if ($data->keterangan === null)

                  @else
                    <textarea disabled rows="3" cols="50">{{ $data->keterangan }}</textarea>
                  @endif
                </td>
                <td class="align-middle fix-column">

                  <!-- Jika lama cuti melebihi sisa cuti -->
                  @if ($data->lama_cuti > $data->cuti)

                    <!-- Jika disetujui -->
                    @if ($data->status === "Disetujui")
                      <a class="btn btn-danger" href="/pengajuan/batal/{{$data->id}}" role="button">Batal</a>

                    <!-- Jika tidak disetujui -->
                    @else

                    @endif

                  <!-- Jika lama cuti tidak melebihi sisa cuti -->
                  @else

                  <!-- Jika disetujui -->
                  @if ($data->status === "Disetujui")
                  <a class="btn btn-danger" href="/pengajuan/batal/{{$data->id}}" role="button">Batal</a>

                  <!-- Jika dibatalkan -->
                  @elseif ($data->status === "Dibatalkan")

                  <!-- Jika tidak disetujui -->
                  @else
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#rincian"
                    data-id="{{$data->id}}"
                    data-nama="{{$data->nama}}"
                    data-status="{{$data->status}}"
                    data-keterangan="{{$data->keterangan}}"
                    data-simpan="/pengajuan/status/{{ $data->id }}">

                    @if ($data->status === "Tidak Disetujui")
                      Re-approval
                    @else
                      Approval
                    @endif

                    </button>
                  @endif
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal Rincian Pengajuan -->
    @include('cuti_approval')

  </section>

  <!-- Javascript CDN and Custom Javascript -->
  @include('behavior')

<script type="text/javascript">

</script>

</body>
</html>

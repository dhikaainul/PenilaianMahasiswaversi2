<!DOCTYPE html>
<html>
    <head>
        <title>Kartu Rapot</title>
        <style>

            * {
                font-family: Arial, Helvetica, sans-serif;
            }

            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
                color: inherit;
                font-size: 1.5rem;
            }
            
            .pr-5, .px-5 {
                padding-right: 3rem !important;
            }

            table {
                border-collapse: collapse;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                background-color: transparent;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
                text-align: left;
                font-size: 16px;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }

            .table {
                border-collapse: collapse !important;
            }
            
            .table td,
            .table th {
                background-color: #ffffff !important;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6 !important;
            }
        </style>
    </head>

    <body>
        <center>
            <h4>JADWAL MENGAJAR GURU</h4>
            
        </center>
        <table>
            <tr>
                <td class="pr-5">NAMA GURU</td>
                <td>:</td>
                <td>{{ $guru_s->nama }}</td>
            </tr>
            <tr>
                <td class="pr-5">NIP</td>
                <td>:</td>
                <td>{{ $guru_s->nip }}</td>
            </tr>
            <tr>
                <td class="pr-5">mapel</td>
                <td>:</td>
                <td>{{ $mapel->nama_mapel }}</td>
            </tr>
        </table>
        <br>
        <table class="table text-nowrap">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Jam Mulai</th>
                        <th>Jam Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($guru as $key => $item)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                             {{$item->day}}
                            </td>
                            <td>{{ $item->start_time }}</td>
                            <td>{{ $item->end_time }}</td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
    </body>
</html>

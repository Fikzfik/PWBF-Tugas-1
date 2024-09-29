@extends('app', ['page' => 'earthquakes'])
{{-- @dd($earthquakes); --}}
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card-body" style="max-width: 800px; margin: 0 auto;">
            <h4 class="card-title">Informasi Gempa Terkini</h4>

            <form id="searchEarthquakeForm" method="GET">
                <div class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Cari berdasarkan kota">
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <!-- Tabel untuk menampilkan gempa -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Lokasi</th>
                            <th>Magnitudo</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Koordinat</th>
                        </tr>
                    </thead>
                    <tbody id="earthquakeTableBody">
                        @if (isset($earthquakes) && count($earthquakes) > 0)
                            @foreach ($earthquakes as $quake)
                                <tr>
                                    <td>{{ $quake['Wilayah'] }}</td>
                                    <td>{{ $quake['Magnitude'] }}</td>
                                    <td>{{ $quake['Tanggal'] }}</td>
                                    <td>{{ $quake['Jam'] }}</td>
                                    <td>{{ $quake['Lintang'] }}, {{ $quake['Bujur'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data gempa ditemukan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

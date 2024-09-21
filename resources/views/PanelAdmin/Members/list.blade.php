@extends('PanelAdmin.blank')
@section('meta_title','Members - List')
@section('meta_description','Description Members List')
@section('meta_author','Telcomixo')
@section('page-name','Listing Members')
@section('page-parent','Members')

@section('head-page')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                 <a href="{{ route('members.create') }}" class="btn btn-primary waves-effect waves-light">Create New Member</a>
               
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">KETERANGAN :</h4>
                <p class="card-title-desc">
                <div class="alert alert-warning">
                    "Listing Members" adalah halaman yang menampilkan daftar semua anggota yang terdaftar. Anda dapat
                    melihat informasi singkat tentang setiap anggota di daftar ini. Untuk melihat informasi lebih
                    lengkap, silakan klik tombol "Detail" yang tersedia di samping setiap anggota. Jika Anda ingin
                    menambahkan anggota baru, klik tombol "Create" untuk membuat data anggota baru.
                </div>
                </p>

                <table id="state-saving-datatable" class="table table-dark activate-select dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>PhoneNo</th>
                            <th>Age</th>
                            <th>Birthday</th>
                            <th>Join Date</th>
                            <th>Status</th>

                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Joshua Barnes</td>
                            <td>852-208-9561x696</td>
                            <td>52</td>
                            <td>1972-03-13</td>
                            <td>2021-04-07</td>
                            <td>Inactive</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Frank Hardy</td>
                            <td>457-522-1279x339</td>
                            <td>32</td>
                            <td>1992-04-11</td>
                            <td>2020-11-10</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Stephanie Joseph</td>
                            <td>748.271.3605x803</td>
                            <td>58</td>
                            <td>1966-07-12</td>
                            <td>2020-05-25</td>
                            <td>Inactive</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Christine Marshall</td>
                            <td>(465)768-1933x5361</td>
                            <td>21</td>
                            <td>2002-10-13</td>
                            <td>2021-11-16</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Caleb Herrera</td>
                            <td>(001)327-4327</td>
                            <td>36</td>
                            <td>1988-09-01</td>
                            <td>2022-05-11</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Keith Schneider</td>
                            <td>+1-855-612-2784x8944</td>
                            <td>58</td>
                            <td>1966-08-10</td>
                            <td>2021-03-20</td>
                            <td>Suspended</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>James Gregory</td>
                            <td>(245)618-8575x399</td>
                            <td>64</td>
                            <td>1960-05-26</td>
                            <td>2024-06-20</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Jose Casey</td>
                            <td>001-024-240-2503x058</td>
                            <td>30</td>
                            <td>1994-05-26</td>
                            <td>2021-04-10</td>
                            <td>Suspended</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Rachel Griffin</td>
                            <td>(631)520-5848</td>
                            <td>27</td>
                            <td>1997-08-13</td>
                            <td>2020-01-18</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Danielle Warner</td>
                            <td>001-738-434-9787x497</td>
                            <td>34</td>
                            <td>1990-06-23</td>
                            <td>2022-06-18</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Brian Richards</td>
                            <td>520.789.6062</td>
                            <td>37</td>
                            <td>1987-07-17</td>
                            <td>2020-12-26</td>
                            <td>Suspended</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Joshua Frank</td>
                            <td>(626)593-4624</td>
                            <td>57</td>
                            <td>1966-09-23</td>
                            <td>2023-08-25</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Virginia Johnson</td>
                            <td>+1-925-640-0226x8187</td>
                            <td>37</td>
                            <td>1987-03-22</td>
                            <td>2021-05-28</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Angela Wade</td>
                            <td>955.919.7429x09174</td>
                            <td>32</td>
                            <td>1992-09-09</td>
                            <td>2023-12-01</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Hayden Lopez</td>
                            <td>087-404-9826x09938</td>
                            <td>63</td>
                            <td>1961-01-10</td>
                            <td>2021-01-26</td>
                            <td>Suspended</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Jeremy Carrillo</td>
                            <td>001-196-287-2254x692</td>
                            <td>60</td>
                            <td>1964-06-03</td>
                            <td>2022-04-28</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Dylan Wiggins</td>
                            <td>001-843-476-7336x154</td>
                            <td>62</td>
                            <td>1962-04-02</td>
                            <td>2021-02-26</td>
                            <td>Active</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>David Caldwell</td>
                            <td>2624186081</td>
                            <td>63</td>
                            <td>1960-10-09</td>
                            <td>2022-06-14</td>
                            <td>Inactive</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Jeffrey Murray</td>
                            <td>498.640.6036x8132</td>
                            <td>49</td>
                            <td>1975-03-28</td>
                            <td>2020-02-29</td>
                            <td>Inactive</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Kimberly Ellis</td>
                            <td>8984277843</td>
                            <td>30</td>
                            <td>1993-12-24</td>
                            <td>2021-09-06</td>
                            <td>Pending</td>
                            <td><button class="btn btn-success waves-effect waves-light">Detail</button> <button class="btn btn-warning waves-effect waves-light">Edit</button></td>
                        </tr>

                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

@endsection

@section('script')
<!-- Buttons examples -->
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>


@endsection
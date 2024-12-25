<div class="card">
    <style>
        .item-center{

        }
    </style>
    <?php
    $data = config('menu-admin');
   
    ?>
    <div class="card-body">
        <h4 class="card-title">Permission List</h4>
        <div class="row">
            <div class="col-md-12">
            <table class="table table-striped" style="border:1px solid">
                <thead style="background-color:#151922">
                   
                    <tr>
                        <td style="border-right:1px solid">Module</td>
                        <td>View<br><input type="checkbox"> </td>
                        <td>Create<br><input type="checkbox"> </td>
                        <td>Edit<br><input type="checkbox"></td>
                        <td>Delete<br><input type="checkbox"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $menu)
                    @foreach($menu as $kMenu => $vMenu)
                    <tr>
                        <td style="border-right:1px solid">{{$vMenu['name']}}</td>
                        @foreach($vMenu['permission'] as $kp => $vp)
                        <td><input  type="checkbox">{{print_r($vp['name'])}}</td>
                        @endforeach
                    </tr>
                   @endforeach
                   
                   @endforeach
                </tbody>
            </table>
            <button>Save Permission</button>
        </div>  
    </div>


    </div>
</div>
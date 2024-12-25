<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="divTable">
                <div class="divRow">
                  <div class="divCell col-md-4">Member Name</div>
                  <div class="divCell col-md-8">{{'Joney'}}</div>
                </div>
                <div class="divRow">
                  <div class="divCell">Phone No</div>
                  <div class="divCell">{{'6282177522260'}}</div>
                </div>
              </div>
            <table>
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Phone No</th>
                        <th>Qty</th>
                    </tr>
                <thead>
                <tbody>
                    <?php $dataOrder = [];?>
                    @foreach($dataOrder as $keyOrder =>$valOrder)
                    <?php
                        $om = new App\Model\Member\Member;
                        $member = $om->where('member_id',$valOrder['member_id']);

                    ?>
                    <tr>
                        <td>{{$valOrder['order_id']}}</td>
                        <td>{{$valOrder['']}}</td>
                        <td>{{$valOrder['']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Outcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/css/argon-dashboard.min.css" integrity="sha512-xX4LTTrPRKtHKQ2OEa6N+8PRWSALWLss8pegG7sJ96j97V+Lw8WHKKLOAjYmkfemrD6dLsW0vX1p/7pE0Yc1gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container  mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">

                    @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif

                       <form action="" method="POST">
                        @csrf
                        <input type="text"  class="btn btn-dark text-white" name="about">
                        <input type="text"  class="btn btn-dark text-white" name="amount">
                        <input type="date" class="btn btn-dark text-white" name="date">
                        <select name="type" id="" class="btn btn-dark">
                            <option value="in">၀င်ငွေ</option>
                            <option value="out">ထွက်ငွေ</option>
                        </select>
                        <input type="submit" value="စာရင်းသွင်းငွေ" class="btn btn-success">
                       </form>
                 
                </div>
            </div>
            <hr>
            
            <div class="col-6">
                
                    <ul class="list-group">
                        @foreach ($data as $d)
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="">
                                {{$d->about}} <br>
                                <small class="text-muted">{{$d->date}}</small>
                            </div>

                            @if($d->type=='in')
                            <small class="text text-success">
                                +{{$d->amount}} ကျပ်
                            </small>
                            @else
                            <small class="text text-danger">
                                -{{$d->amount}} ကျပ်
                            </small>
                            @endif
                        </li>
                        @endforeach
                        
                        
                    </ul>
                
            </div>
            <div class="col-6">
                <div class="card card-body mt-3">
                    <div class="d-flex justify-content-between">
                        <h5>Today Chart</h5>
                        <div class="">
                            <small class="text-success">၀င်ငွေ +{{$total_income}}</small>
                            <small class="text-success">ထွက်ငွေ -{{$total_outcome}}</small>
                        </div>
                    </div>
                    <hr class="p-0 m-0">
                        <div class="mt-3">
                            <canvas id="inout"></canvas>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
<script>
 const ctx = document.getElementById('inout');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: @json($day_arr),
    datasets: [
        {
      label: '၀င်ငွေ',
      data: @json($income_amount),
      borderWidth: 1,
      backgroundColor :'#2DCE89'
    },
    {
      label: 'ထွက်ငွေ',
      data: @json($outcome_amount),
      borderWidth: 1,
      backgroundColor :'#F5365C'
    }
]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>

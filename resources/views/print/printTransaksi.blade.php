<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
</head>
<body>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
          <div class="card mb-4">
            <div class="card-body">
              <div class="table-responsive" style="font-size: 12px">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th class="ps-2">Customer Name</th>
                      <th class="ps-2">Product</th>
                      <th class="ps-2">Qty</th>
                      <th class="ps-2">Price</th>
                      <th class="ps-2">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $qty = 0;
                        $total = 0;
                    @endphp
                    @foreach ($order_Details as $item)
                        <tr>
                            <td>{{ $item->order->customer_name }}</td>
                            <td>{{ $item->product->produck_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ number_format($item->price) }}</td>
                            <td>Rp. {{ $item->total }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><h6>{{ $qty += $item->qty }}</h6></td>
                            <td></td>
                            {{-- <td><h6>Rp. {{ subTotal | format_number }}</h6></td> --}}
                        </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>

</body>
</html>

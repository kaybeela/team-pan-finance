@extends('layouts.app')
@section('content')
    <h2 class="ml-3">Total Amount Tracked</h2>
    <div class="container-fluid">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home1">THIS WEEK</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu1">THIS MONTH</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu2">THIS YEAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#menu3">CUSTOM RANGE</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container active" id="home1">
                <div class="col-md-6 offset-md-3 mt-5">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4>TOTAL AMOUNT SPENT THIS WEEK: <br><br> NGN
                                {{ $week }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="menu1">
                <div class="col-md-6 offset-md-3 mt-5">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4>TOTAL AMOUNT SPENT THIS MONTH: <br><br> NGN
                               {{ $month }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="menu2">
                <div class="col-md-6 offset-md-3 mt-5">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4>TOTAL AMOUNT SPENT THIS YEAR: <br><br> NGN
                                {{ $year }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="menu3">
                <div class="col-md-6 offset-md-3 mt-5">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h4>Pick A Date Range</h4>
                            <div style="height: 70px">
                                <div class="spinner-grow d-none" id="report_loading"></div>
                                <div id="response"></div>
                            </div>
                            <form id="get_custom_report">
                                <div class="form-group">
                                    <label for="from">From</label>
                                    <input type="date" class="form-control" id="from" required>
                                </div>
                                <div class="form-group">
                                    <label for="to">To</label>
                                    <input type="date" class="form-control" id="to" required>
                                </div>
                                <button type="submit"  class="btn btn-primary d-block mx-auto col-md-6">
                                    SUBMIT
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        onload = function () {
            $(`#get_custom_report`).submit((e) => {
                e.preventDefault();
                const spinner = document.getElementById('report_loading');
                spinner.classList.remove('d-none');
                let from = $(`#from`).val();
                let to = $(`#to`).val();
                let url = `{{ route('expenses.report.custom') }}?from=${from}&to=${to}`;
                axios.get(url).then(res =>{
                    $(`#response`).html(`TOTAL AMOUNT SPENT DURING SELECTED PERIOD: <b>${res.data.total} NGN</b>`)
                }).catch(err => {
                    $(`#response`).html(`<span class="text-danger">ERROR: ${err.response.data.message || err.toString()}</span>`);
                }).finally(() => {
                    spinner.classList.add('d-none');
                })

            });
        };
    </script>
@endpush

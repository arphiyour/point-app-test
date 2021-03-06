<div class="table-responsive" >
	<table class="table table-striped table-bordered">
	<thead>
	    <tr>
	        <th>No</th>
	        <th>Name</th>
	        <th>Form Reference</th>
	        <th>Description</th>
	        <th>Date</th>
	        <th>Amount</th>
	        <th>Remaining</th>
	        <th>15 Days</th>
	        <th>16-30 Days</th>
	        <th>31-60 Days</th>
	        <th>61 - Days</th>
	    </tr>
	</thead>
		<tbody >
		<?php $i = 1; $amount=0; $remain=0; $a=0; $b=0; $c=0; $d=0; ?>
		@foreach($list_report as $report)
		<?php
            $sum=0;
            if ($report->detail) {
                $sum=$report->detail->sum('amount');
            }

            $remaining = $report->amount - $sum;
            $datediff = date_diff(\Carbon::now(), date_create($report->form_date));
            $position = $datediff->format("%R%a") * -1;
            $amount = $amount + $report->amount;
            $remain = $remain + $remaining;
        ?>
		<tr>
			<td>{{$i}}</td>
			<td>{{$report->person->name}}</td>
			<td>{{$report->formulirReference->form_number}}</td>
			<td>{{$report->notes}}</td>
			<td>{{date_format_view($report->form_date)}}</td>
			<td class="text-right">{{number_format_price($report->amount)}}</td>
			<td class="text-right">{{number_format_price($remaining)}}</td>
			<td class="text-right">@if($position <= 15){{number_format_price($remaining)}} <?php $a=$a+$remaining; ?> @endif </td>
			<td class="text-right">@if($position > 15 && $position <= 30){{number_format_price($remaining)}} <?php $b=$b+$remaining; ?> @endif</td>
			<td class="text-right">@if($position > 30 && $position <= 60){{number_format_price($remaining)}} <?php $c=$c+$remaining; ?> @endif</td>
			<td class="text-right">@if($position > 60){{number_format_price($remaining)}} <?php $d=$d+$remaining; ?> @endif</td>
		</tr>	
		<?php $i++; ?>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
			<td colspan="5"></td>
			<td class="text-right">@if($amount > 0){{number_format_price($amount)}}@endif</td>
			<td class="text-right">@if($remain > 0){{number_format_price($remain)}}@endif</td>
			<td class="text-right">@if($a > 0){{number_format_price($a)}}@endif</td>
			<td class="text-right">@if($b > 0){{number_format_price($b)}}@endif</td>
			<td class="text-right">@if($c > 0){{number_format_price($c)}}@endif</td>
			<td class="text-right">@if($d > 0){{number_format_price($d)}}@endif</td>
		</tr>
		</tfoot> 
	</table>
</div>

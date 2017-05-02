<li>
    {{$icon}}
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i> {{$record->created_at->format('H:i')}}</span>

        <h3 class="timeline-header">
            {{$heading}}
        </h3>

        <div class="timeline-body">
        </div>
        <div class="timeline-footer">
        </div>
    </div>
</li>
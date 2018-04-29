<button class="btn swal-dialog-target {{ $ip->blocked?' btn-danger':' btn-default' }}"
        data-dialog-msg="{{ $ip->blocked?'取消阻塞':'阻塞' }} IP {{ $ip->id }} ?{{ $ip->blocked?'':'阻塞后此IP将不能访问你的网站' }}"
        data-url="{{ route('ip.block',$ip->id) }}"
        data-dialog-title="{{ $ip->blocked?'取消阻塞':'阻塞' }}"
        title="{{ $ip->blocked?'Un Block':'Block' }}">
    <i class="fa {{ $ip->blocked?'fa-check':'fa-close' }} fa-fw"></i>
</button>
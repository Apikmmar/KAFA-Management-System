@php
    $userRole = auth()->user();
    $isMUIPAdmin = $userRole->role_id == 1;
    $isKAFAAdmin = $userRole->role_id == 2;
    $isParent = $userRole->role_id == 3;
    $isTeacher = $userRole->role_id == 4;

    $btncolor = null;

    if ($isMUIPAdmin) {
        $btncolor = 'btn-danger';
    } elseif($isKAFAAdmin) {
        $btncolor = 'btn-primary';
    } elseif($isParent) {
        $btncolor = 'btn-warning';
    } elseif($isTeacher) {
        $btncolor = 'btn-success';
    }
@endphp

<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
        <div class="list-group list-group-flush mt-5">

            {{-- USE BY ALL USER --}}
            <a href="/home" class="list-group-item btn {{ $btncolor }} btn-lg">Home</a>
            <a href="/profile" class="list-group-item btn {{ $btncolor }} btn-lg">Profile</a>

            @if ($isMUIPAdmin)
                {{-- MUIP Admin --}}
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Report</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>

            @elseif($isKAFAAdmin)
                {{-- KAFA Admin --}}
                <a href="/registerteacher" class="list-group-item btn {{ $btncolor }} btn-lg">Add Teacher</a>
                <a href="/all_class" class="list-group-item btn {{ $btncolor }} btn-lg">All Class</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Report</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Result</a>

            @elseif($isParent)
                {{-- Parent --}}
                <a href="/registerchild" class="list-group-item btn {{ $btncolor }} btn-lg">Register Child</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Child Activity</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Result</a>

            @elseif($isTeacher)
                {{-- Teacher --}}
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Manage Class</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">KAFA Assessment</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Report</a>
                <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Notice</a>

            @endif

            {{-- USE BY ALL USER --}}
            <a href="#" class="list-group-item btn {{ $btncolor }} btn-lg">Bulletin Board</a>

        </div>
    </div>
</nav>

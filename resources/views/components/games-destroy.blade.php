@props(['game'])

<form id="deleteForm" action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
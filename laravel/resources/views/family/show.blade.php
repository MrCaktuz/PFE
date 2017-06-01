<?php $validated = 0 ?>
@foreach( Auth::user()->roles as $role )
    @if( $role->title == "AdminAll" )
        <?php $validated = 1 ?>
    @endif
@endforeach

@extends ( 'partials.layoutAdmin' )

@section ( 'content' )
    @if( !$validated )
        @include( 'partials.accessDenied' )
	@else
	<?php $family_mails = ''; ?>
	<div class="jumbotron">
		<h1 class="text-center">Fiche famille&nbsp;: {{ $familyName }}</h1>
	</div>
	<div class="pageWrap">
		
		@include ( 'partials.adminAside' )

		<div class="col-sm-9">
			@foreach( $familyMembers as $familyMember )
			@if( $familyMember->family_chief )
					<?php $family_mails = $family_mails . $familyMember->email; ?>
				<div class="idCard">
					<img class="idCard__photo" src="{{ $familyMember->photo ? $familyMember->photo : "/img/profilAvatar.jpg" }}" alt="Photo de {{ $familyMember->first_name }}" width="200" height="200">
					<div class="idCard__content">
						<h2 class="idCard__title">Chef de famille</h2>
						<h3 class="idCard__subTitle">{{ $familyMember->first_name }} {{ $familyMember->last_name }}</h3>
						<a class="idCard__phone" href="tel:{{ $familyMember->phone }}" title="Téléphoner au {{ $familyMember->phone }}">{{ $familyMember->phone }}</a>
						<a class="idCard__mail" href="mailto:{{ $familyMember->email }}" title="Envoyer un email à {{ $familyMember->email }}">{{ $familyMember->email }}</a>
						<a class="idCard__link" href="/admin/user/{{ $familyMember->id }}" title="Voir la fiche de {{ $familyMember->first_name }} {{ $familyMember->last_name }}">Détails</a>		
					</div>
				</div>
			@endif
			@endforeach
	        <div class="list-group">
				<div class="idCard__wrap">
					@foreach( $familyMembers as $familyMember )
						@if( !($familyMember->family_chief) )
							<?php $family_mails = $family_mails . ',' . $familyMember->email; ?>
							<div class="idCard">
								<img class="idCard__photo" src="{{ $familyMember->photo ? $familyMember->photo : "/img/profilAvatar.jpg" }}" alt="Photo de {{ $familyMember->first_name }}" width="200" height="200">
								<div class="idCard__content">
									<h2 class="idCard__title">Membre</h2>
									<h3 class="idCard__subTitle">{{ $familyMember->first_name }} {{ $familyMember->last_name }}</h3>
									<a class="idCard__phone" href="tel:{{ $familyMember->phone }}" title="Téléphoner au {{ $familyMember->phone }}">{{ $familyMember->phone }}</a>
									<a class="idCard__mail" href="mailto:{{ $familyMember->email }}" title="Envoyer un email à {{ $familyMember->email }}">{{ $familyMember->email }}</a>
									<a class="idCard__link" href="/admin/user/{{ $familyMember->id }}">Détails</a>		
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
			<div class="button__wrap--left">
				<a class="button button--primary" href="/admin/register&family={{ $familySlug }}">Ajouter un membre à cette famille</a>
				<a class="button button--secondary" href="mailto:{{ $family_mails }}">Envoyer un mail à cette famille</a>
				<a class="button button--secondary" href="/admin/family">Retour à la liste des familles</a>
			</div>
		</div>
	</div>
	@endif
@endsection
@extends('layouts.app')
@section('title', __('Заказы'))
@section('content')

		<main class="main">
			<div class="container">
				<section class="payment">
					<div class="general__title">
						<h1 class="title">История платежей</h1>
					</div>
					<div class="mail__time-sent">
						<p></p>
					</div>
					
					<div class="payment-wrap">
						
						<div class="payment-price">
							<div class="payment-row light-blue">
								<div class="payment-left">
									<span class="payment-text">Название продукта</span>
								</div>
								<div class="payment-right">
									<span class="payment-text">Номер заказа</span>
								</div>
								<div class="payment-right">
									<span class="payment-text">Стоимость</span>
								</div>
								<div class="payment-right">
									<span class="payment-text">Дата</span>
								</div>
							</div>
							<div class="payment-row">
								<div class="payment-left">
									<span class="payment-text">Push-уведомления (ежемесячная подписка) - 30 000 подписчиков</span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>№667</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>1 300 руб</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>07.10.2020</b></span>
								</div>
							</div>
							<div class="payment-row">
								<div class="payment-left">
									<span class="payment-text">Push-уведомления (ежемесячная подписка) - 30 000 подписчиков</span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>№667</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>1 300 руб</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>07.10.2020</b></span>
								</div>
							</div>
							<div class="payment-row">
								<div class="payment-left">
									<span class="payment-text">Push-уведомления (ежемесячная подписка) - 30 000 подписчиков</span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>№667</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>1 300 руб</b></span>
								</div>
								<div class="payment-right">
									<span class="payment-text"><b>07.10.2020</b></span>
								</div>
							</div>
						</div>
						
						
						

						
					</section>
				</div>
			</main>

@endsection

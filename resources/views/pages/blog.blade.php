@extends('layouts.app')
@section('title', __('Блог'))
@section('content')

<main class="main">
    <div id="app">
        <section class="blog-offer">
            <div class="container">
                <h1>Блог</h1>
                <div class="blog-offer__wrapper">
                    <div class="blog__wrapper">
                        <div class="blog__item">
                            <div class="section-blog__content">
                                <img src="{{ asset('images/image12.png') }}" alt="">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog-offeringer">
                            <div class="blog__item">
                                <div class="section-blog__content">
                                    <img src="{{ asset('images/image12.png') }}" alt="">
                                    <a class="section-item__title">
                                        <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                        <div class="author">
                                            <span>10.12.2020</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="blog-wrapp-wrapp">
                                <div class="blog__item">
                                    <div class="section-blog__content">
                                        <a class="section-item__title">
                                            <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="blog__item">
                                    <div class="section-blog__content">
                                        <a class="section-item__title">
                                            <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</main>
@endsection
@extends('layouts.app')
@section('title', __('Блог'))
@section('content')

<main class="main">
    <div id="app">
        <section style="display: block;" class="blog-offer">
            <div class="container">
                <h1>Блог</h1>
                <div class="blog-offer__wrapper">
                    <div class="blog__wrapper">
                        <div class="blog__item">
                            <img src="{{ asset('images/testing.png')}}" alt="">
                            <div class="section-blog__content">
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
                                <img src="{{ asset('images/testing.png')}}" alt="">
                                <div class="section-blog__content">
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
                                <img src="{{ asset('images/testing.png')}}" alt="">

                                    <div class="section-blog__content">
                                        <a class="section-item__title">
                                            <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="blog__item">
                                <img src="{{ asset('images/testing.png')}}" alt="">

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
                <h2>Все новости</h2>
                <div class="blog-offer__wrapper">
                    <div class="blog__wrapper">
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__item">
                        <img src="{{ asset('images/testing.png')}}" alt="">

                            <div class="section-blog__content">
                                <a class="section-item__title">
                                    <p>Lorem ipsum dolor sit amet cosectetur adipiscing elit</p>
                                    <div class="author">
                                        <span>10.12.2020</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="blog-dots">
                    <a href=""><i class="fas fa-chevron-left"></i></a>
                    <a class="pp">1</a>
                    <a class="pp">2</a>
                    <a class="pp">3</a>
                    <a href=""><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </section>
    </div>

</main>
@endsection
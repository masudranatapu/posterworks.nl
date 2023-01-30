@extends('frontend.layouts.app')

@section('title') {{ $data['title'] ?? 'Page header' }} @endsection

@push('style') @endpush

@section('content')
    <!--  faq  -->
    <div class="faq_sec section">
        <div class="container">
            <div class="row">
                <div class="section_title mb-4">
                    <h5>{{ $data['title'] ?? 'Page header' }}</h5>
                </div>
                <div class="faq_question_wrap">
                    <div class="accordion" id="accordionExample">

                        @foreach ($data['faqs'] as $key => $row)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading_{{ $key }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_{{ $key }}" aria-expanded="true" aria-controls="collapse_{{ $key }}">
                                   {{ $row->title }}
                                </button>
                            </h2>
                            <div id="collapse_{{ $key }}" class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" aria-labelledby="heading_{{ $key }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{ $row->body }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
{{--
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Why do we use it?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nostrum
                                        similique officia quasi modi laborum maiores soluta. Quam accusamus quo
                                        asperiores vero illo fuga cupiditate aperiam necessitatibus. Voluptas, iusto
                                        nisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Where does it come from?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nostrum
                                        similique officia quasi modi laborum maiores soluta. Quam accusamus quo
                                        asperiores vero illo fuga cupiditate aperiam necessitatibus. Voluptas, iusto
                                        nisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Where does it come from?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nostrum
                                        similique officia quasi modi laborum maiores soluta. Quam accusamus quo
                                        asperiores vero illo fuga cupiditate aperiam necessitatibus. Voluptas, iusto
                                        nisi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Where does it come from?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nostrum
                                        similique officia quasi modi laborum maiores soluta. Quam accusamus quo
                                        asperiores vero illo fuga cupiditate aperiam necessitatibus. Voluptas, iusto
                                        nisi.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush

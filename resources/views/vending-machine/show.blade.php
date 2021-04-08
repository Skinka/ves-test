<?php
/**
 * @var $products  \App\Models\Product[]
 * @var $banknotes \App\Models\Banknote[]
 * @var $coins     \App\Models\Coin[]
 */
?>

@extends('layouts.main')

@section('content')
    <div class="machine">
        <div>
            <div class="display">
                <div class="has-money">
                    На счету: <span id="filled">0</span>грн.
                </div>
                <div class="errors"></div>
                <div class="products">
                    @foreach($products as $product)
                        <button class="btn"
                                @if($product->amount == 0)
                                disabled="disabled"
                                @endif
                                data-id="{{ $product->id }}"
                                id="buy-product-{{ $product->id }}">
                            {{ $product->name }} - {{ $product->price }}грн
                        </button>
                    @endforeach
                </div>
                <div class="dispenser"></div>
            </div>
            <div class="money-receiver">
                <div class="receiver">
                    Купюро-приемник
                    <div class="banknotes">
                        @foreach($banknotes as $banknote)
                            <button class="btn"
                                    id="set-banknote-{{ $banknote->denomination }}"
                                    data-id="{{ $banknote->id }}"
                            >
                                {{ $banknote->denomination }} грн
                            </button>
                        @endforeach
                    </div>
                    Монето-приемник
                    <div class="coins">
                        @foreach($coins as $coin)
                            <button class="btn"
                                    id="set-coin-{{ $coin->denomination }}"
                                    data-id="{{ $coin->id }}"
                            >
                                @if($coin->denomination >= 1)
                                    {{ $coin->denomination }} грн
                                @else
                                    {{ $coin->denomination * 100 }} коп
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="change">
                    <button class="btn" id="get-change">Забрать сдачу</button>
                </div>
            </div>
        </div>
    </div>
@endsection

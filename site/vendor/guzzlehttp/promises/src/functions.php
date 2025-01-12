<?php

namespace GuzzleHttp\Promise;

function queue(?TaskQueueInterface $assign = null)
{
    return Utils::queue($assign);
}

function task(callable $task)
{
    return Utils::task($task);
}

function promise_for($value)
{
    return Create::promiseFor($value);
}

function rejection_for($reason)
{
    return Create::rejectionFor($reason);
}

function exception_for($reason)
{
    return Create::exceptionFor($reason);
}

function iter_for($value)
{
    return Create::iterFor($value);
}

function inspect(PromiseInterface $promise)
{
    return Utils::inspect($promise);
}

function inspect_all($promises)
{
    return Utils::inspectAll($promises);
}

function unwrap($promises)
{
    return Utils::unwrap($promises);
}

function all($promises, $recursive = false)
{
    return Utils::all($promises, $recursive);
}

function some($count, $promises)
{
    return Utils::some($count, $promises);
}

function any($promises)
{
    return Utils::any($promises);
}

function settle($promises)
{
    return Utils::settle($promises);
}

function each(
    $iterable,
    ?callable $onFulfilled = null,
    ?callable $onRejected = null
) {
    return Each::of($iterable, $onFulfilled, $onRejected);
}

function each_limit(
    $iterable,
    $concurrency,
    ?callable $onFulfilled = null,
    ?callable $onRejected = null
) {
    return Each::ofLimit($iterable, $concurrency, $onFulfilled, $onRejected);
}

function each_limit_all(
    $iterable,
    $concurrency,
    ?callable $onFulfilled = null
) {
    return Each::ofLimitAll($iterable, $concurrency, $onFulfilled);
}

function is_fulfilled(PromiseInterface $promise)
{
    return Is::fulfilled($promise);
}

function is_rejected(PromiseInterface $promise)
{
    return Is::rejected($promise);
}

function is_settled(PromiseInterface $promise)
{
    return Is::settled($promise);
}

function coroutine(callable $generatorFn)
{
    return Coroutine::of($generatorFn);
}

---
title: "Run background tasks with ThreadPoolTaskExecutor"
date: 2026-10-04
description: "Learn what ThreadPoolTaskExecutor does and run a small example in a JUnit test."
tags: ["spring", "java", "testing"]
status: published
type: guide
level: beginner
---

# Run background tasks with ThreadPoolTaskExecutor

> `ThreadPoolTaskExecutor` is Spring's helper for running work on a pool of reusable threads.

## Context

- Some work should not block the main thread, such as sending email or calling a slow API.
- Creating a new thread for every task is hard to control.
- This guide assumes basic Java and a simple JUnit 5 test.

## Prerequisites

- Java 21
- Spring Framework on the classpath (`spring-context`)
- JUnit 5

## Main idea

A **thread pool** keeps a small group of worker threads ready.
You submit tasks. The pool runs them when a worker is free.

`ThreadPoolTaskExecutor` is Spring's wrapper around that idea.
You set the pool size, give it a name prefix, then call `execute(...)`.

## Walkthrough

### 1. Create and configure the executor

```java
ThreadPoolTaskExecutor executor = new ThreadPoolTaskExecutor();
executor.setCorePoolSize(2);
executor.setMaxPoolSize(2);
executor.setQueueCapacity(10);
executor.setThreadNamePrefix("demo-");
executor.initialize();
```

What these settings mean:

| Setting | Meaning |
|---------|---------|
| `corePoolSize` | How many worker threads stay ready |
| `maxPoolSize` | Maximum number of worker threads |
| `queueCapacity` | How many tasks can wait if workers are busy |
| `threadNamePrefix` | Name prefix for worker threads, useful in logs |

!!! tip
    Call `initialize()` before you submit work. Without it, the executor is not ready.

### 2. Understand the flow

1. You submit a task with `execute(...)`.
2. A free worker thread runs the task.
3. If all workers are busy, the task waits in the queue.
4. When the work is done, the worker can take the next task.

### 3. Run a basic example in a test

This test starts a small pool, runs three tasks, and waits until all finish.

```java
import org.junit.jupiter.api.Test;
import org.springframework.scheduling.concurrent.ThreadPoolTaskExecutor;

import java.util.concurrent.CountDownLatch;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.atomic.AtomicInteger;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertTrue;

class SimpleTaskExecutorTest {

    @Test
    void runsTasksInAThreadPool() throws Exception {
        ThreadPoolTaskExecutor executor = new ThreadPoolTaskExecutor();
        executor.setCorePoolSize(2);
        executor.setMaxPoolSize(2);
        executor.setQueueCapacity(10);
        executor.setThreadNamePrefix("demo-");
        executor.initialize();

        AtomicInteger counter = new AtomicInteger();
        CountDownLatch done = new CountDownLatch(3);

        for (int i = 0; i < 3; i++) {
            executor.execute(() -> {
                counter.incrementAndGet();
                System.out.println(Thread.currentThread().getName());
                done.countDown();
            });
        }

        assertTrue(done.await(2, TimeUnit.SECONDS));
        assertEquals(3, counter.get());

        executor.shutdown();
    }
}
```

Why the test uses these types:

- **`AtomicInteger`** — a counter that is safe when several threads update it.
- **`CountDownLatch`** — a wait point. Each task calls `countDown()`. The test waits until the count reaches zero.
- **`executor.shutdown()`** — stops the pool when the test ends.

When you run the test, the console may print names like `demo-1` and `demo-2`.
That shows the work ran on pool threads, not only on the test thread.

### 4. Where to place the test

In a Maven project:

```text
src/test/java/com/example/demo/SimpleTaskExecutorTest.java
```

Then run it from your IDE, or with:

```bash
./mvnw test -Dtest=SimpleTaskExecutorTest
```

## Common mistakes

- **Mistake:** forget `initialize()`  
  **Why:** the executor is not started  
  **Fix:** call `initialize()` after you set the pool options

- **Mistake:** end the test without waiting  
  **Why:** the test may finish before the tasks run  
  **Fix:** wait with `CountDownLatch`, `Future.get()`, or a similar tool

- **Mistake:** set a tiny queue and a tiny pool, then submit many tasks  
  **Why:** new tasks may be rejected when the pool and queue are full  
  **Fix:** raise `queueCapacity`, raise the pool size, or handle rejected tasks

## Summary

- `ThreadPoolTaskExecutor` runs tasks on reusable worker threads.
- Set pool size, queue capacity, and a thread name prefix.
- Call `initialize()` before work and `shutdown()` when you finish.
- In tests, wait for tasks with `CountDownLatch` so assertions stay reliable.

## Further reading

- [Spring docs: ThreadPoolTaskExecutor](https://docs.spring.io/spring-framework/docs/current/javadoc-api/org/springframework/scheduling/concurrent/ThreadPoolTaskExecutor.html)
- [Spring docs: Task execution and scheduling](https://docs.spring.io/spring-framework/reference/integration/scheduling.html)

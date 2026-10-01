---
title: "Read console input with Scanner in Java"
date: 2026-10-01
description: "Learn how to read text and numbers from the keyboard with the Scanner class in Java."
tags: ["java"]
status: published
type: guide
level: beginner
---

# Read console input with Scanner in Java

> Use `Scanner` with `System.in` to read text and numbers that the user types in the console.

## Context

- Many beginner programs need input from the keyboard.
- Java does not read console input with a single built-in keyword.
- This guide assumes you can write a small `main` method and run a Java file.

## Prerequisites

- Java 17 or later installed
- A text editor or IDE
- Basic idea of variables and `System.out.println`

## Main idea

Create a `Scanner` object connected to `System.in`.
Then call methods like `nextLine()` or `nextInt()` to read what the user types.

## Walkthrough

### 1. Import Scanner

```java
import java.util.Scanner;
```

`Scanner` lives in the `java.util` package, so you must import it.

### 2. Create a Scanner for the keyboard

```java
public class HelloInput {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
    }
}
```

`System.in` is the standard input stream. Here it means the keyboard in the console.

### 3. Read a line of text

```java
System.out.print("What is your name? ");
String name = input.nextLine();
System.out.println("Hello, " + name);
```

`nextLine()` reads the full line until the user presses Enter.

### 4. Read a whole number

```java
System.out.print("How old are you? ");
int age = input.nextInt();
System.out.println("Next year you will be " + (age + 1));
```

`nextInt()` reads the next integer token.
If the user types text that is not a number, the program throws an exception.

### 5. Close the Scanner when you finish

```java
input.close();
```

Closing frees the resource when your program no longer needs input.

!!! tip
    For tiny beginner programs, closing `Scanner` on `System.in` is optional.
    Still, closing it is a good habit when the program ends.

### Full example

```java
import java.util.Scanner;

public class HelloInput {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("What is your name? ");
        String name = input.nextLine();

        System.out.print("How old are you? ");
        int age = input.nextInt();

        System.out.println("Hello, " + name + ". You are " + age + " years old.");

        input.close();
    }
}
```

## Common mistakes

- **Mistake:** forget the import  
  **Why:** the compiler cannot find `Scanner`  
  **Fix:** add `import java.util.Scanner;` at the top of the file

- **Mistake:** call `nextLine()` right after `nextInt()`  
  **Why:** `nextInt()` leaves the Enter key in the input buffer, so `nextLine()` may read an empty line  
  **Fix:** call an extra `nextLine()` to clear the line, or read everything with `nextLine()` and convert numbers later

- **Mistake:** type text when the code expects `nextInt()`  
  **Why:** Scanner cannot parse that token as an `int`  
  **Fix:** enter only digits, or validate input before you convert it

## Summary

- Import `java.util.Scanner` before you use it.
- Create `new Scanner(System.in)` to read from the keyboard.
- Use `nextLine()` for text and `nextInt()` for whole numbers.
- Close the Scanner when the program is done.
- Watch the `nextInt()` + `nextLine()` mix; it often surprises beginners.

## Further reading

- [Oracle docs: Scanner](https://docs.oracle.com/en/java/javase/17/docs/api/java.base/java/util/Scanner.html)

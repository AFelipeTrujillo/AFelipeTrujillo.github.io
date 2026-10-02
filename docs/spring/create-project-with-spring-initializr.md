---
title: "Create a Spring Boot project with Spring Initializr"
date: 2026-10-02
description: "Use start.spring.io to create a Spring Boot project with Java 21 and Maven."
tags: ["spring", "java", "maven"]
status: published
type: guide
level: beginner
---

# Create a Spring Boot project with Spring Initializr

> Use [Spring Initializr](https://start.spring.io) to generate a Spring Boot project. For now, choose **Java 21** and **Maven**.

## Context

- Starting a Spring Boot app by hand is slow and easy to misconfigure.
- Spring Initializr builds a ready project with the right files and dependencies.
- This guide assumes you know what Java is and can open a ZIP file or import a project in an IDE.

## Prerequisites

- Java 21 installed
- An IDE such as IntelliJ IDEA, VS Code, or Eclipse
- A browser

## Main idea

Open [start.spring.io](https://start.spring.io), pick the project options, add the dependencies you need, then generate the project.
For new learning projects, prefer **Maven** and **Java 21**.

## Walkthrough

### 1. Open Spring Initializr

Go to [https://start.spring.io](https://start.spring.io).

This website creates a Spring Boot starter project for you.

### 2. Choose Maven as the build tool

Set **Project** to **Maven**.

Why Maven for now:

- Most Spring Getting Started guides use Maven.
- The `pom.xml` file is easy to follow in beginner tutorials.
- IDE support for Maven is strong and common.

!!! note
    Gradle is also a good choice later. Start with Maven so examples match the official guides more often.

### 3. Choose Java 21

Set **Language** to **Java** and **Java** version to **21**.

Why Java 21 for now:

- Java 21 is an **LTS** release. LTS means Long-Term Support.
- Current Spring Boot versions work well with Java 21.
- You get a modern baseline for new projects, with a long support window.
- Features such as virtual threads are available if you need them later.

!!! tip
    Prefer an LTS version for learning and real projects. Java 21 is the best default today for new Spring Boot work.

### 4. Fill in the project metadata

Use simple values, for example:

| Field | Example |
|-------|---------|
| Group | `com.example` |
| Artifact | `demo` |
| Name | `demo` |
| Package name | `com.example.demo` |
| Packaging | `Jar` |

Keep **Jar** for a normal Spring Boot application.

### 5. Add a first dependency

Click **Add Dependencies** and choose something small, such as **Spring Web**.

You can add more later. For a first project, one dependency is enough.

### 6. Generate and open the project

1. Click **Generate**.
2. Download the ZIP file.
3. Unzip it.
4. Open the folder in your IDE.

You should see files like:

```text
demo/
├── pom.xml
├── src/main/java/.../DemoApplication.java
└── src/main/resources/application.properties
```

`pom.xml` is the Maven build file.
`DemoApplication.java` is the Spring Boot entry point.

### 7. Run the app

In the IDE, run `DemoApplication`.
Or from the project folder:

```bash
./mvnw spring-boot:run
```

On Windows, use:

```bash
mvnw.cmd spring-boot:run
```

If you added Spring Web, the app starts a local web server.

## Common mistakes

- **Mistake:** pick a very old Java version  
  **Why:** you miss current defaults and some newer Spring Boot support  
  **Fix:** choose Java 21 for new projects

- **Mistake:** add many dependencies on day one  
  **Why:** the project becomes harder to understand  
  **Fix:** add only what you need now, such as Spring Web

- **Mistake:** change Group and Package to random values every time  
  **Why:** imports and package names get confusing  
  **Fix:** keep a simple pattern like `com.example.demo` while learning

## Summary

- Use [start.spring.io](https://start.spring.io) to create Spring Boot projects.
- Choose **Maven** so beginner guides are easier to follow.
- Choose **Java 21** because it is the current LTS default for new Spring work.
- Generate the ZIP, open it in your IDE, and run `DemoApplication`.

## Further reading

- [Spring Initializr](https://start.spring.io)
- [Spring Boot Getting Started](https://spring.io/guides/gs/spring-boot/)
- [Oracle Java SE support roadmap](https://www.oracle.com/java/technologies/java-se-support-roadmap.html)

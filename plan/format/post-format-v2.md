# Post format v2

Standard for every blog post on this site.

**Goal:** clear technical notes and guides. Easy to scan. Easy to reuse later.

**Language:** English at CEFR B1. Short sentences. Common words. Explain a technical term the first time you use it.

**Tone:** clean article. Not a diary. You may use "I" once in Context if it helps, but do not add a personal journal section.

**Code:** use invented, minimal examples only. No real work code. No secrets. Examples must still be coherent (names, imports, versions).

---

## Post types

| Type | Use when | Main question |
|------|----------|---------------|
| `note` | You explain a concept or idea | What is this / why does it matter? |
| `guide` | You show how to do something | How do I do this? |

Use one type per post. One post = one clear question.

---

## Frontmatter

```yaml
---
title: "Clear and specific title"
date: 2026-10-01
description: "One or two sentences. What the reader will learn."
tags: ["python", "fastapi"]
status: published
type: note
level: beginner
---
```

| Field | Required | Values |
|-------|----------|--------|
| `title` | yes | Same idea as the H1. Specific, not vague. |
| `date` | yes | `YYYY-MM-DD` |
| `description` | yes | Short summary for listings and SEO |
| `tags` | yes | 1–3 tags from the closed list below |
| `status` | yes | `draft` \| `published` |
| `type` | yes | `note` \| `guide` |
| `level` | yes | `beginner` \| `intermediate` \| `advanced` |

### Title rules

- Prefer present tense.
- Name the topic and the outcome.
- Good: `Fix CORS in FastAPI with middleware`
- Bad: `CORS notes` / `Things about Docker`

---

## Closed tag list

Use only these tags. Add a new tag only when no existing tag fits.

**Languages**

- `python`
- `javascript`
- `typescript`
- `go`
- `sql`

**Tools and platform**

- `docker`
- `linux`
- `git`
- `ci`

**Frameworks and libraries**

- `fastapi`
- `django`
- `react`
- `mkdocs`

**Topics**

- `testing`
- `debugging`
- `architecture`
- `performance`
- `security`
- `api`

**Other**

- `tools`
- `career`

Max **3 tags** per post. Put the main topic first.

---

## Required and optional sections

| Section | `note` | `guide` |
|---------|--------|---------|
| Takeaway (blockquote) | required | required |
| Context | required | required |
| Prerequisites | optional | required |
| Main idea | required | required |
| Walkthrough | optional (short) | required |
| Common mistakes | optional | required |
| Summary | required | required |
| Further reading | optional | optional |

---

## Template: `note`

```markdown
---
title: "Clear and specific title"
date: 2026-10-01
description: "One or two sentences. What the reader will learn."
tags: ["python", "architecture"]
status: draft
type: note
level: beginner
---

# Clear and specific title

> One sentence with the main takeaway.

## Context

- What problem or question is this about?
- Why does it matter?
- What should the reader already know?

## Main idea

State the key conclusion in a few lines.

## Walkthrough

### First point

Explain one idea.

```python
# Minimal invented example
```

Explain the important line(s). Do not dump long files.

### Second point

Continue only if needed.

## Summary

- Takeaway 1
- Takeaway 2
- Takeaway 3

## Further reading

- [Official docs](https://example.com)
```

---

## Template: `guide`

```markdown
---
title: "Clear and specific title"
date: 2026-10-01
description: "One or two sentences. What the reader will learn."
tags: ["fastapi", "api"]
status: draft
type: guide
level: intermediate
---

# Clear and specific title

> One sentence with the main takeaway.

## Context

- What problem are you solving?
- When do you need this?
- What should the reader already know?

## Prerequisites

- Tool or version (example: Python 3.11+)
- Basic idea the reader needs (example: HTTP status codes)

## Main idea

State the approach in a few lines before the steps.

## Walkthrough

### 1. First step

Short explanation.

```python
# Minimal invented example
```

Explain the important line(s).

### 2. Second step

...

### 3. Third step

...

## Common mistakes

- **Mistake:** what goes wrong  
  **Why:** short cause  
  **Fix:** what to do instead

## Summary

- Takeaway 1
- Takeaway 2
- Takeaway 3

## Further reading

- [Official docs](https://example.com)
```

---

## Full examples

These are complete sample posts. Use them as a reference when you write.

### Example: `note`

Topic: what `==` and `is` mean in Python.

````markdown
---
title: "Understand == and is in Python"
date: 2026-10-01
description: "Learn when to compare values with == and when to compare identity with is."
tags: ["python"]
status: published
type: note
level: beginner
---

# Understand == and is in Python

> Use `==` to compare values. Use `is` to check if two names point to the same object.

## Context

- Many beginners mix `==` and `is`.
- The code may seem to work, then fail in a surprising way.
- This note assumes basic Python variables.

## Main idea

`==` asks: "Do these values look the same?"

`is` asks: "Are these the same object in memory?"

For normal value checks, prefer `==`. Use `is` mainly with `None`.

## Walkthrough

### Compare values with `==`

```python
left = [1, 2, 3]
right = [1, 2, 3]

print(left == right)  # True: same values
print(left is right)  # False: two different lists
```

Both lists hold the same numbers, so `==` is `True`.
They are still two objects, so `is` is `False`.

### Check `None` with `is`

```python
result = None

if result is None:
    print("No value yet")
```

This is the common and clear way to test for `None`.

## Summary

- `==` compares values.
- `is` compares object identity.
- Prefer `==` for most checks.
- Prefer `is` for `None`.

## Further reading

- [Python docs: Comparisons](https://docs.python.org/3/reference/expressions.html#comparisons)
````

### Example: `guide`

Topic: add a simple health endpoint in FastAPI.

````markdown
---
title: "Add a health check endpoint in FastAPI"
date: 2026-10-01
description: "Create a small /health endpoint that returns OK for monitoring tools."
tags: ["fastapi", "api", "python"]
status: published
type: guide
level: beginner
---

# Add a health check endpoint in FastAPI

> Create a `/health` route that returns a simple JSON status for uptime checks.

## Context

- Monitoring tools need a fast endpoint to see if the API is up.
- A health check should stay small and stable.
- This guide assumes you already created a FastAPI app.

## Prerequisites

- Python 3.11+
- FastAPI and Uvicorn installed
- Basic idea of HTTP routes

## Main idea

Add one GET route that returns `{"status": "ok"}`.
Keep it free of database or auth checks for a basic version.

## Walkthrough

### 1. Create a minimal app

```python
# main.py
from fastapi import FastAPI

app = FastAPI()
```

This creates the app object that will hold your routes.

### 2. Add the health route

```python
@app.get("/health")
def health():
    return {"status": "ok"}
```

`@app.get("/health")` maps GET requests on `/health` to this function.
The return value becomes JSON automatically.

### 3. Run and test

```bash
uvicorn main:app --reload
```

Then open `http://127.0.0.1:8000/health`.
You should see `{"status":"ok"}`.

!!! tip
    Keep `/health` cheap. Do not call external services here unless you need a deep check.

## Common mistakes

- **Mistake:** put database queries in `/health`  
  **Why:** the check becomes slow and fails for the wrong reason  
  **Fix:** keep a basic status endpoint, and add a separate deep check later

- **Mistake:** protect `/health` with login  
  **Why:** monitors cannot read it without credentials  
  **Fix:** leave the basic health route public, or use a simple shared token

## Summary

- Add a GET `/health` route that returns a small JSON payload.
- Keep the basic check fast and simple.
- Test it with Uvicorn in the browser or with curl.
- Split "is the process up?" from "are all dependencies up?"

## Further reading

- [FastAPI: First steps](https://fastapi.tiangolo.com/tutorial/first-steps/)
````

---

## Writing rules

1. **One post = one question.** Split large topics into several posts.
2. **Put the takeaway first.** The blockquote must work alone.
3. **One idea per section.** Keep paragraphs to 2–4 sentences.
4. **Keep code small.** Show only what supports the idea.
5. **Explain key lines.** Do not comment every line.
6. **Use lists** for steps, options, and takeaways.
7. **Use bold** for key terms, not for full sentences.
8. **Use tables** only to compare options, commands, or trade-offs.
9. **Use admonitions** when they help:

```markdown
!!! tip
    Prefer this when X is true.

!!! warning
    This fails when Y is missing.

!!! note
    Extra context that is useful but not required.
```

10. **Invented examples only.** Change names, paths, and data. Keep the example runnable or clearly coherent.

---

## Checklist before publish

- [ ] Frontmatter is complete and valid
- [ ] `type` matches the content (`note` or `guide`)
- [ ] Tags are from the closed list (max 3)
- [ ] Title is specific
- [ ] Takeaway blockquote is one clear sentence
- [ ] Required sections for that type are present
- [ ] Code examples are invented and minimal
- [ ] English is B1: short sentences, common words
- [ ] `status` is `published` only when the post is ready

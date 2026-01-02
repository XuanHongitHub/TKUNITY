---
description: Create a new Product Requirements Document (PRD) through structured brainstorming
---

# /pm:prd-new - Create New PRD

Launch comprehensive brainstorming to create a Product Requirements Document.

## Usage
```
/pm:prd-new <feature-name>
```

## Prerequisites
1. Validate feature name is kebab-case (lowercase letters, numbers, hyphens only)
2. Create `.agent/prds/` directory if not exists
3. Check if PRD already exists - ask to overwrite if yes

## PRD Template

Create file: `.agent/prds/<feature-name>.md`

```markdown
---
name: <feature-name>
description: <brief one-line description>
status: backlog
created: <current ISO datetime>
---

# PRD: <Feature Name>

## Executive Summary
Brief overview and value proposition

## Problem Statement
- What problem are we solving?
- Why is this important now?

## User Stories
### Primary User Personas
- Persona 1: Description
- Persona 2: Description

### User Journeys
- As a [user], I want [goal] so that [benefit]

## Requirements

### Functional Requirements
- Core features and capabilities
- User interactions and flows

### Non-Functional Requirements
- Performance expectations
- Security considerations
- Scalability needs

## Success Criteria
- Measurable outcomes
- Key metrics and KPIs

## Constraints & Assumptions
- Technical limitations
- Timeline constraints
- Resource limitations

## Out of Scope
- What we're explicitly NOT building

## Dependencies
- External dependencies
- Internal team dependencies
```

## Post-Creation
1. Confirm: "✅ PRD created: .agent/prds/<feature-name>.md"
2. Suggest next step: "Ready to create implementation epic? Run: /pm:prd-parse <feature-name>"

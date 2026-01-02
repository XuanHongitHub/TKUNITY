---
description: Convert a PRD into a technical implementation epic
---

# /pm:prd-parse - Parse PRD to Epic

Transform a Product Requirements Document into a technical implementation plan.

## Usage
```
/pm:prd-parse <feature-name>
```

## Prerequisites
1. Verify PRD exists: `.agent/prds/<feature-name>.md`
2. Create epic directory: `.agent/epics/<feature-name>/`

## Instructions

1. **Read the PRD** from `.agent/prds/<feature-name>.md`
2. **Analyze requirements** and translate to technical approach
3. **Create epic file** with implementation plan

## Epic Template

Create file: `.agent/epics/<feature-name>/epic.md`

```markdown
---
name: <feature-name>
description: <brief description>
status: planning
created: <current ISO datetime>
prd: .agent/prds/<feature-name>.md
progress: 0%
---

# Epic: <Feature Name>

## Overview
Brief technical summary from PRD

## Technical Approach

### Architecture
- Key architectural decisions
- Component interactions
- Technology choices

### Database Changes
- New tables/migrations
- Schema modifications

### API/Backend Changes
- New endpoints
- Service modifications
- Business logic changes

### Frontend Changes
- New components
- UI modifications
- State management changes

## Task Breakdown Preview

### Phase 1: Foundation
1. Task 1 description
2. Task 2 description

### Phase 2: Core Implementation
3. Task 3 description
4. Task 4 description

### Phase 3: Polish & Testing
5. Task 5 description
6. Task 6 description

## Dependencies
- External dependencies
- Internal dependencies

## Risks & Mitigations
- Risk 1: Mitigation strategy
- Risk 2: Mitigation strategy

## Definition of Done
- [ ] All tasks completed
- [ ] Tests passing
- [ ] Documentation updated
- [ ] Code reviewed
- [ ] Deployed to staging
```

## Post-Creation
1. Update PRD status to "in-progress"
2. Confirm: "✅ Epic created: .agent/epics/<feature-name>/epic.md"
3. Suggest next step: "Break into tasks with: /pm:epic-decompose <feature-name>"

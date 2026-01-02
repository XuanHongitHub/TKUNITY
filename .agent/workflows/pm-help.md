---
description: Show all available PM commands with descriptions
---

# /pm:help - PM System Help

Display all available project management commands.

## Usage
```
/pm:help
```

## Output

```markdown
# 📋 Project Management Commands

## PRD Commands (Product Requirements)
| Command | Description |
|---------|-------------|
| `/pm:prd-new <name>` | Create new PRD through brainstorming |
| `/pm:prd-parse <name>` | Convert PRD to implementation epic |
| `/pm:prd-list` | List all PRDs |
| `/pm:prd-edit <name>` | Edit existing PRD |

## Epic Commands (Implementation Plans)
| Command | Description |
|---------|-------------|
| `/pm:epic-decompose <name>` | Break epic into tasks |
| `/pm:epic-show <name>` | Display epic and tasks |
| `/pm:epic-list` | List all epics |
| `/pm:epic-close <name>` | Mark epic as complete |

## Task Commands
| Command | Description |
|---------|-------------|
| `/pm:task-start <epic> <number>` | Start working on task |
| `/pm:task-complete <epic> <number>` | Mark task as done |
| `/pm:task-block <epic> <number>` | Mark task as blocked |

## Workflow Commands
| Command | Description |
|---------|-------------|
| `/pm:next [epic]` | Show next priority task |
| `/pm:status` | Project status dashboard |
| `/pm:standup` | Daily standup summary |
| `/pm:blocked` | Show all blocked tasks |
| `/pm:in-progress` | Show tasks in progress |

## Quick Start Flow

1. Create PRD: `/pm:prd-new my-feature`
2. Create Epic: `/pm:prd-parse my-feature`  
3. Create Tasks: `/pm:epic-decompose my-feature`
4. Start Work: `/pm:task-start my-feature 001`
5. Check Progress: `/pm:status`
```

## Core Philosophy

> **No Vibe Coding**: Every line of code must trace back to a specification.

1. 🧠 **Brainstorm** - Think deeper than comfortable
2. 📝 **Document** - Write specs that leave nothing to interpretation
3. 📐 **Plan** - Architect with explicit technical decisions
4. ⚡ **Execute** - Build exactly what was specified
5. 📊 **Track** - Maintain transparent progress

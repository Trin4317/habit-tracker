import { beforeAll, afterAll, afterEach } from "vitest";
import { setupServer } from "msw/node";
import { rest } from "msw";

const habits = {
    data: [
        {
            name: 'Drink water',
            times_per_day: 3,
            executions_count: 1
        }
    ]
}

const validationErrors = {
    errors: {
        name: [
            'The name field is required'
        ],
        times_per_day: [
            'The times_per_day field is required'
        ]
    }
}

export const requestHandlers = [
    rest.get('http://localhost:3000/api/habits', (req, res, ctx) => {
        return res(ctx.status(200), ctx.json(habits))
    }),

    rest.post('http://localhost:3000/api/habits', async (req, res, ctx) => {
        // extract the request body in json format to separate variables
        const { name, times_per_day } = await req.json()

        if (name == '' || times_per_day == '') {
            return res(ctx.status(422), ctx.json(validationErrors))
        }

        habits.data.push({
            id: habits.data.length + 1,
            name: name,
            times_per_day: times_per_day,
            executions_count: 0
        })

        return res(ctx.status(200), ctx.json(habits))
    }),

    rest.post('http://localhost:3000/api/habits/:habit/execute', (req, res, ctx) => {
        return res(ctx.status(200), ctx.json({}))
    }),

    rest.put('http://localhost:3000/api/habits/:habit', async (req, res, ctx) => {
        const { name, times_per_day } = await req.json()

        if (name == '' || times_per_day == '') {
            return res(ctx.status(422), ctx.json(validationErrors))
        }

        habits.data[0].name = name
        habits.data[0].times_per_day = times_per_day

        return res(ctx.status(200), ctx.json(habits))
    }),

    rest.delete('http://localhost:3000/api/habits/:habit', (req, res, ctx) => {
        habits.data.shift()

        return res(ctx.status(200), ctx.json(habits))
    }),
]

const server = setupServer(...requestHandlers)

beforeAll(() => server.listen({ onUnhandledRequest: 'error' }))

afterAll(() => server.close)

afterEach(() => server.resetHandlers())
